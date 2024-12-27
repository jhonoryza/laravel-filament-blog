<?php

namespace App\Livewire;

use App\CommonMark\CodeBlockWithCopyRenderer;
use App\Models\Post;
use App\Tempest\HighlightExtension;
use Butschster\Head\Facades\Meta;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;
use Livewire\Component;

class PostDetailPage extends Component
{
    public Post $post;
    public string $content = '';

    public function mount(Post $post)
    {
        $this->post = $post;

        $title = Str::limit(ucwords($this->post->title), 60);
        $desc = Str::limit($this->post->summary ?? config('meta_tags.description.default'), 160);
        Meta::prependTitle($title)
            ->setDescription($desc);
    }

    public function render(): View
    {
        $environment = new Environment;

        $environment
            ->addExtension(new CommonMarkCoreExtension)
            ->addExtension(new HighlightExtension)
            ->addExtension(new GithubFlavoredMarkdownExtension);

        $markdown = new MarkdownConverter($environment);

        $this->content = $this->post->is_markdown ?
            $markdown->convert($this->post->content)
            : $this->post->content;

        return view('livewire.post-detail-page');
    }
}
