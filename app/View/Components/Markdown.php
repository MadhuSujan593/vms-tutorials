<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Markdown extends Component
{
    public string $html;
    public array $toc = [];

    public function __construct(string $content)
    {
        // STEP 1: Sanitize the raw content before any processing.
        // Strips dangerous wrapper divs and attributes from copy-pasted content.
        $content = $this->sanitizeHtml($content);

        // STEP 2: Convert content to HTML.
        // Detect if content HAS Markdown markers, even if it's wrapped in HTML.
        $hasMarkdown = preg_match('/(?:^|\n|>|\s)(#{1,6}\s|\!\[|\[.*\]\(|\*\*|__|```)/', $content);
        
        $converter = new \League\CommonMark\GithubFlavoredMarkdownConverter([
            'html_input' => 'allow',
            'allow_unsafe_links' => false,
        ]);

        if ($hasMarkdown) {
            // Pre-process: Unwrap Markdown headers/images from <p> tags so the parser can see them.
            $content = preg_replace('/<p>\s*(#{1,6}\s|!\[|```)\s*(.*?)\s*<\/p>/i', "$1$2\n", $content);
            
            // Ensure blank lines between HTML blocks and Markdown for better parsing
            $content = preg_replace('/(<\/(?:p|h[1-6]|ul|ol|table)>)\s*(#{1,6}\s|\!\[|```)/i', "$1\n\n$2", $content);
            
            $this->html = $converter->convert($content)->getContent();
        } elseif (preg_match('/<(p|pre|h[1-6]|ul|ol|table)\b/i', $content)) {
            // Already complex HTML (from TinyMCE) — use as-is
            $this->html = $content;
        } else {
            // Plain text — convert to HTML via Markdown
            $this->html = $converter->convert($content)->getContent();
        }

        // STEP 3: Generate Table of Contents from h2 and h3 headings.
        $this->buildToc();
    }

    /**
     * Extract h2 and h3 headings from the HTML, inject anchor IDs,
     * and build the TOC array for the sidebar.
     */
    private function buildToc(): void
    {
        preg_match_all('/<(h[23])([^>]*)>(.*?)<\/h[23]>/is', $this->html, $matches);
        
        $usedSlugs = [];
        foreach ($matches[1] as $index => $tag) {
            $attrs = $matches[2][$index];
            $innerHtml = $matches[3][$index];
            
            // Clean text for TOC display
            $text = $this->cleanHeadingText($innerHtml);
            
            // Skip empty headings (e.g. <h2></h2> from broken pastes)
            if ($text === '') {
                continue;
            }
            
            // Truncate very long headings for TOC sidebar (prevent overflow)
            $displayTitle = \Illuminate\Support\Str::limit($text, 60);
            
            // Generate a unique slug for the anchor
            $baseSlug = \Illuminate\Support\Str::slug($text);
            if ($baseSlug === '') {
                continue; // Skip headings that produce no valid slug
            }
            $slug = $baseSlug;
            $counter = 1;
            while (in_array($slug, $usedSlugs)) {
                $slug = $baseSlug . '-' . $counter++;
            }
            $usedSlugs[] = $slug;
            
            // Skip if heading already has an id attribute
            if (preg_match('/\bid\s*=\s*"/i', $attrs)) {
                // Update existing id to our slug for consistent TOC linking
                $originalTagStr = "<$tag" . $attrs . ">" . $innerHtml . "</$tag>";
                $newAttrs = preg_replace('/\bid\s*=\s*"[^"]*"/i', "id=\"$slug\"", $attrs);
                $newTagStr = "<$tag" . $newAttrs . ">" . $innerHtml . "</$tag>";
            } else {
                // Inject id attribute
                $originalTagStr = "<$tag" . $attrs . ">" . $innerHtml . "</$tag>";
                $newTagStr = "<$tag" . $attrs . " id=\"$slug\">" . $innerHtml . "</$tag>";
            }
            
            // Replace only the first occurrence to handle duplicate headers
            $pos = strpos($this->html, $originalTagStr);
            if ($pos !== false) {
                $this->html = substr_replace($this->html, $newTagStr, $pos, strlen($originalTagStr));
            }
            
            $this->toc[] = [
                'tag' => $tag,
                'text' => $displayTitle,
                'slug' => $slug
            ];
        }
    }

    /**
     * Clean heading inner HTML into plain text suitable for TOC display.
     * Handles &nbsp;, HTML entities, Markdown artifacts, and extra whitespace.
     */
    private function cleanHeadingText(string $innerHtml): string
    {
        // Strip HTML tags first
        $text = strip_tags($innerHtml);
        
        // Decode HTML entities (e.g. &amp; → &, &ndash; → –)
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        // Remove non-breaking spaces (Unicode \xC2\xA0) — these survive html_entity_decode
        $text = str_replace("\xC2\xA0", ' ', $text);
        
        // Remove any remaining &nbsp; literals (in case they weren't entity-encoded)
        $text = str_ireplace('&nbsp;', ' ', $text);
        
        // Remove Markdown image/link syntax artifacts
        $text = preg_replace('/!\[.*?\]\(.*?\)|\[.*?\]\(.*?\)/', '', $text);
        
        // Remove Markdown formatting markers
        $text = preg_replace('/[#*`_~]/', '', $text);
        
        // Normalize whitespace (collapse multiple spaces, trim)
        $text = trim(preg_replace('/\s+/', ' ', $text));
        
        return $text;
    }

    /**
     * Sanitize HTML content to remove dangerous wrapper elements pasted from
     * external tools like ChatGPT, Google Docs, Notion, etc.
     */
    private function sanitizeHtml(string $html): string
    {
        // Strip ALL <div> tags (both opening and closing).
        // Pasted divs from external tools are non-semantic wrappers that carry
        // dangerous Tailwind classes (absolute, overflow-clip, pointer-events-none).
        $html = preg_replace('/<\/?div[^>]*>/i', '', $html);

        // Strip empty paragraphs that create large gaps between sections.
        // These are commonly pasted from ChatGPT, Google Docs, etc.
        // Matches: <p></p>, <p> </p>, <p>&nbsp;</p>, <p><br></p>, <p><br/></p>
        $html = preg_replace('/<p[^>]*>(\s|&nbsp;|<br\s*\/?>)*<\/p>/i', '', $html);

        // Strip role="text" attributes from pasted content
        $html = preg_replace('/\s*role="text"/i', '', $html);

        // Strip data attributes from pasted content (data-start, data-end, data-section-id)
        $html = preg_replace('/\s*data-(?:start|end|section-id)="[^"]*"/i', '', $html);

        return $html;
    }

    /**
     * Get a plain text excerpt from markdown content for SEO meta descriptions.
     */
    public static function getExcerpt(string $content, int $limit = 160): string
    {
        // Strip div tags to avoid pasted wrapper issues
        $content = preg_replace('/<\/?div[^>]*>/i', '', $content);
        
        $converter = new \League\CommonMark\GithubFlavoredMarkdownConverter([
            'html_input' => 'allow',
            'allow_unsafe_links' => false,
        ]);
        
        $html = $converter->convert($content)->getContent();
        $plain = strip_tags($html);
        
        // Clean non-breaking spaces and normalize whitespace
        $plain = str_replace("\xC2\xA0", ' ', $plain);
        $plain = preg_replace('/\s+/', ' ', trim($plain));
        
        $excerpt = \Illuminate\Support\Str::limit($plain, $limit);
        
        return str_replace(["\n", "\r", '"'], ' ', $excerpt);
    }

    public function render(): View|Closure|string
    {
        return view('components.markdown');
    }
}
