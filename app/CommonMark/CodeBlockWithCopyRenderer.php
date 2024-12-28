<?php

namespace App\CommonMark;

use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use Tempest\Highlight\Highlighter;
use Tempest\Highlight\WebTheme;

class CodeBlockWithCopyRenderer implements NodeRendererInterface
{
    public function __construct(
        private Highlighter $highlighter = new Highlighter(),
    )
    {
    }

    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        if (!($node instanceof FencedCode)) {
            throw new \InvalidArgumentException('Node must be an instance of ' . FencedCode::class);
        }

        preg_match('/^(?<language>[\w]+)(\{(?<startAt>[\d]+)\})?/', $node->getInfoWords()[0] ?? 'txt', $matches);

        // Set up highlighter
        $highlighter = $this->highlighter;

        if ($startAt = ($matches['startAt']) ?? null) {
            $highlighter = $highlighter->withGutter((int)$startAt);
        }

        $language = $matches['language'] ?? 'txt';

        // Parse the code with highlighting
        $parsed = $highlighter->parse($node->getLiteral(), $language);

        // Get the theme for rendering (if any)
        $theme = $highlighter->getTheme();

        // Start generating HTML output for the code block
        if ($theme instanceof WebTheme) {
            $codeHtml = $theme->preBefore($highlighter) . $parsed . $theme->preAfter($highlighter);
        } else {
            $codeHtml = '<pre data-lang="' . $language . '" class="notranslate">' . $parsed . '</pre>';
        }

        return <<<HTML
<div class="code-block-container">
    <div class="code-header" x-data="{ copied: false }">
        <span class="language-label">{$language}</span>
        <div class="flex gap-2">
            <button class="copy-btn"
            x-on:click="copyToClipboard(\$el); copied = true; setTimeout(() => copied = false, 1000)"
            aria-label="Copy"
            >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-sm">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7 5C7 3.34315 8.34315 2 10 2H19C20.6569 2 22 3.34315 22 5V14C22 15.6569 20.6569 17 19 17H17V19C17 20.6569 15.6569 22 14 22H5C3.34315 22 2 20.6569 2 19V10C2 8.34315 3.34315 7 5 7H7V5ZM9 7H14C15.6569 7 17 8.34315 17 10V15H19C19.5523 15 20 14.5523 20 14V5C20 4.44772 19.5523 4 19 4H10C9.44772 4 9 4.44772 9 5V7ZM5 9C4.44772 9 4 9.44772 4 10V19C4 19.5523 4.44772 20 5 20H14C14.5523 20 15 19.5523 15 19V10C15 9.44772 14.5523 9 14 9H5Z" fill="currentColor"></path>
                </svg>
            </button>
            <button
                class="copy-btn"
                x-show="copied"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
            >
                Copied!
            </button>
        </div>
    </div>
    $codeHtml
</div>
HTML;
    }
}
