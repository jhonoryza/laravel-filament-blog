<?php

namespace App\Http\Controllers;

use App\Livewire\Concerns\MetaTrait;
use App\Models\Post;
use Illuminate\Http\Request;

class PostShowController extends Controller
{
    use MetaTrait;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Post $post)
    {
        $meta = $this->getMetaDetail(
            title: $post->title,
            desc: $post->summary ?? config('meta_tags.description.default'),
            url: route('posts.show', $post),
            imageTwUrl: $post->getTwitterImageUrl(),
            imageUrl: $post->getThumbnailImageUrl(),
            keywords: $post->categories()->pluck('name')->implode(','),
            author: $post->author->getProfileUrl(),
            publishedTime: $post->getPublishedAtIso8601(),
            section: $post->categories()->first()?->name ?? '',
        );
        return inertia()->render('Post/Show', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'is_markdown' => $post->is_markdown,
                'content' => $post->content,
                'author_name' => $post->author->name,
                'categories_name' => $post->categories()->pluck('name')->implode(', '),
                'thumbnail' => $post->getThumbnailImageUrl(),
                'publishedAt' => $post->published_at->format('j F Y'),
            ],
            'meta' => $meta
        ]);
    }
}
