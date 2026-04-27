<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Markdown extends Component
{
    public string $html;
    public array $toc = [];

    /**
     * Dangerous CSS classes that break layout when pasted from external tools
     * (ChatGPT, Google Docs, Notion, etc.). These classes are interpreted by
     * Tailwind on our site and cause absolute positioning, overflow clipping,
     * and pointer-event blocking.
     */
    private static array $dangerousClasses = [
        'absolute', 'fixed', 'sticky', 'relative',
        'inset-0', 'inset-x-0', 'inset-y-0', 'inset-x-4', 'top-0', 'top-12', 'bottom-0', 'bottom-4',
        'pointer-events-none', 'pointer-events-auto',
        'overflow-clip', 'overflow-hidden', 'overflow-auto', 'overflow-scroll',
        'z-40', 'z-50', 'z-1!',
        'h-full', 'w-full', 'min-h-0', 'min-w-0',
    ];

    /**
     * Regex patterns for class names that should be stripped (prefixed patterns).
     */
    private static array $dangerousPatterns = [
        '/^(token-|corner-|lxnfua_|border-radius-)/',  // ChatGPT-specific token classes
        '/^bg-token-/',                                   // ChatGPT token backgrounds
    ];

    public function __construct(string $content)
    {
        // STEP 1: Sanitize the raw content before any processing.
        // This strips dangerous wrapper divs and classes from copy-pasted content.
        $content = $this->sanitizeHtml($content);

        // Detect if content HAS Markdown markers, even if it's currently wrapped in HTML
        $hasMarkdown = preg_match('/(?:^|\n|>|\s)(#{1,6}\s|\!\[|\[.*\]\(|\*\*|__|```)/', $content);
        
        // Configuration for CommonMark
        $converter = new \League\CommonMark\GithubFlavoredMarkdownConverter([
            'html_input' => 'allow',
            'allow_unsafe_links' => false,
        ]);

        if ($hasMarkdown) {
            // Pre-process: If TinyMCE wrapped Markdown headers or images in <p> tags, unwrap them
            // so the Markdown parser can see them at the start of blocks.
            $content = preg_replace('/<p>\s*(#{1,6}\s|!\[|```)\s*(.*?)\s*<\/p>/i', "$1$2\n", $content);
            
            // Ensure blank lines between HTML blocks and Markdown for better parsing
            $content = preg_replace('/(<\/(?:p|h[1-6]|ul|ol|table|div)>)\s*(#{1,6}\s|\!\[|```)/i', "$1\n\n$2", $content);
            
            $this->html = $converter->convert($content)->getContent();
        } else {
            // Check if it's already complex HTML (from TinyMCE)
            if (preg_match('/<(p|pre|h[1-6]|ul|ol|table|div)\b/i', $content)) {
                $this->html = $content;
            } else {
                // Plain text - convert to HTML via Markdown for safety
                $this->html = $converter->convert($content)->getContent();
            }
        }

        // Simple TOC generation - extract h2 and h3
        preg_match_all('/<(h[23])([^>]*)>(.*?)<\/h[23]>/i', $this->html, $matches);
        
        $usedSlugs = [];
        foreach ($matches[1] as $index => $tag) {
            $attrs = $matches[2][$index];
            $innerHtml = $matches[3][$index];
            
            // Clean text for TOC: decode entities, remove MD symbols, links, and collapse spaces
            $text = html_entity_decode(strip_tags($innerHtml), ENT_QUOTES, 'UTF-8');
            $text = preg_replace('/!\[.*?\]\(.*?\)|\[.*?\]\(.*?\)/', '', $text); // Remove MD images and links
            $text = preg_replace('/[#*`_~]|&nbsp;/', '', $text); // Remove MD markers and nbsp
            $text = trim(preg_replace('/\s+/', ' ', $text)); // Normalize whitespace
            
            // Truncate very long headers for TOC (prevent sidebar breakage)
            $displayTitle = \Illuminate\Support\Str::limit($text, 60);
            
            $baseSlug = \Illuminate\Support\Str::slug($text);
            $slug = $baseSlug;
            $counter = 1;
            while (in_array($slug, $usedSlugs)) {
                $slug = $baseSlug . '-' . $counter++;
            }
            $usedSlugs[] = $slug;
            
            // Inject ID into the HTML using the original content to avoid breaking structure
            $originalTagStr = "<$tag" . $attrs . ">" . $innerHtml . "</$tag>";
            $newTagStr = "<$tag" . $attrs . " id=\"$slug\">" . $innerHtml . "</$tag>";
            
            // Replace only the first occurrence to handle duplicate headers correctly
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
     * Sanitize HTML content to remove dangerous wrapper elements pasted from
     * external tools like ChatGPT, Google Docs, Notion, etc. These tools embed
     * their own Tailwind/CSS classes that conflict with the site's Tailwind setup.
     */
    private function sanitizeHtml(string $html): string
    {
        // Step 1: Strip ALL <div> tags (both opening and closing).
        // Pasted divs from external tools are non-semantic wrappers that carry
        // dangerous Tailwind classes (absolute, overflow-clip, pointer-events-none, etc.).
        // Removing just the opening tags but leaving closers creates orphaned </div>
        // that close the page's own containers, so we strip both completely.
        $html = preg_replace('/<\/?div[^>]*>/i', '', $html);

        // Step 2: Strip role="text" attributes that cause accessibility issues
        $html = preg_replace('/\s*role="text"/i', '', $html);

        // Step 3: Strip data attributes from pasted content (data-start, data-end, data-section-id, etc.)
        $html = preg_replace('/\s*data-(?:start|end|section-id)="[^"]*"/i', '', $html);

        return $html;
    }

    /**
     * Get a plain text excerpt from markdown content for SEO meta descriptions.
     */
    public static function getExcerpt(string $content, int $limit = 160): string
    {
        $converter = new \League\CommonMark\GithubFlavoredMarkdownConverter([
            'html_input' => 'allow',
            'allow_unsafe_links' => false,
        ]);
        
        // Strip all div tags to avoid pasted wrapper issues in excerpts
        $content = preg_replace('/<\/?div[^>]*>/', '', $content);
        
        $html = $converter->convert($content)->getContent();
        $plain = strip_tags($html);
        $excerpt = \Illuminate\Support\Str::limit($plain, $limit);
        
        return str_replace(["\n", "\r", '"'], ' ', $excerpt);
    }

    public function render(): View|Closure|string
    {
        return view('components.markdown');
    }
}

