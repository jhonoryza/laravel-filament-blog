<?php

namespace App\Tempest;

use App\CommonMark\CodeBlockWithCopyRenderer;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use League\CommonMark\Extension\ExtensionInterface;
use Tempest\Highlight\CommonMark\InlineCodeBlockRenderer;
use Tempest\Highlight\Highlighter;

class HighlightExtension implements ExtensionInterface
{
    public function __construct(
        private ?Highlighter $highlighter = new Highlighter(),
    )
    {
    }

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment
            ->addRenderer(FencedCode::class, new CodeBlockWithCopyRenderer($this->highlighter), 10)
            ->addRenderer(Code::class, new InlineCodeBlockRenderer($this->highlighter), 10);
    }
}
