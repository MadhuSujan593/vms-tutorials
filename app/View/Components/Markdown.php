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
        $converter = new \League\CommonMark\CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        $this->html = $converter->convert($content)->getContent();

        // Simple TOC generation - extract h2 and h3
        preg_match_all('/<(h[23])>(.*?)<\/h[23]>/i', $this->html, $matches);
        
        foreach ($matches[1] as $index => $tag) {
            $text = strip_tags($matches[2][$index]);
            $slug = \Illuminate\Support\Str::slug($text);
            
            // Inject ID into the HTML
            $this->html = str_replace("<$tag>{$matches[2][$index]}</$tag>", "<$tag id=\"$slug\">{$matches[2][$index]}</$tag>", $this->html);
            
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
        $converter = new \League\CommonMark\CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
        
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
