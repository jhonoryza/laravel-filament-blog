<?php

namespace App\Livewire;

use App\Livewire\Concerns\MetaTrait;
use App\Models\Post;
use App\Tempest\HighlightExtension;
use Illuminate\Contracts\View\View;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;
use Livewire\Component;

class PostDetailPage extends Component
{
    public Post $post;
    public string $content = '';
    use MetaTrait;

    public function mount(Post $post)
    {
        $this->post = $post;

        $this->setMetaDetail(
            title: $post->title,
            desc: $post->summary ?? config('meta_tags.description.default'),
            url: route('posts.show', $post),
            imageUrl: $post->getTwitterImageUrl(),
            keywords: $post->categories()->pluck('name')->implode(','),
            author: $post->author->getProfileUrl(),
            publishedTime: $post->getPublishedAtIso8601(),
            section: $post->categories()->first()?->name ?? '',
        );
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
