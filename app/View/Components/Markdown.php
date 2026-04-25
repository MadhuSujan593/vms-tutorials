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
        // Legacy Support: Only convert via CommonMark if the content is Markdown.
        // TinyMCE always generates HTML with <p>, <ul>, or <pre> tags, which should skip parsing.
        if (preg_match('/<(p|pre|h[1-6]|ul|ol|table|div)\b/i', $content)) {
            $this->html = $content;
        } else {
            $converter = new \League\CommonMark\GithubFlavoredMarkdownConverter([
                'html_input' => 'allow',
                'allow_unsafe_links' => false,
            ]);
            $this->html = $converter->convert($content)->getContent();
        }

        // Simple TOC generation - extract h2 and h3
        preg_match_all('/<(h[23])([^>]*)>(.*?)<\/h[23]>/i', $this->html, $matches);
        
        foreach ($matches[1] as $index => $tag) {
            $attrs = $matches[2][$index];
            $text = strip_tags($matches[3][$index]);
            $slug = \Illuminate\Support\Str::slug($text);
            
            // Inject ID into the HTML
            $originalTagStr = "<$tag" . $attrs . ">" . $matches[3][$index] . "</$tag>";
            $newTagStr = "<$tag" . $attrs . " id=\"$slug\">" . $matches[3][$index] . "</$tag>";
            $this->html = str_replace($originalTagStr, $newTagStr, $this->html);
            
            $this->toc[] = [
                'tag' => $tag,
                'text' => $text,
                'slug' => $slug
            ];
        }
    }

    /**
     * Get a plain text excerpt from markdown content for SEO meta descriptions.
     */
    public static function getExcerpt(string $content, int $limit = 160): string
    {
        if (preg_match('/<(p|pre|h[1-6]|ul|ol|table|div)\b/i', $content)) {
            $html = $content;
        } else {
            $converter = new \League\CommonMark\GithubFlavoredMarkdownConverter([
                'html_input' => 'allow',
                'allow_unsafe_links' => false,
            ]);
            $html = $converter->convert($content)->getContent();
        }
        $plain = strip_tags($html);
        $excerpt = \Illuminate\Support\Str::limit($plain, $limit);
        
        return str_replace(["\n", "\r", '"'], ' ', $excerpt);
    }

    public function render(): View|Closure|string
    {
        return view('components.markdown');
    }
}
