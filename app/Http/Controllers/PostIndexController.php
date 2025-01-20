<?php

namespace App\Http\Controllers;

use App\Livewire\Concerns\MetaTrait;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class PostIndexController extends Controller
{
    use MetaTrait;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $search = $request->search;
        $isFullReload = !$request->hasHeader('X-Inertia-Partial-Data');
        $page = $request->page ?? 1;
        if ($isFullReload) {
            $page = 1;
            $request->merge(['page' => $page]);
        }

        /** @var Paginator $posts */
        $posts = Post::query()
            ->whereNotNull('published_at')
            ->when($search, fn($q, $value) => $q->where('title', 'ilike', '%' . $value . '%'))
            ->orderBy('is_highlighted', 'desc')
            ->orderBy('published_at', 'desc')
            ->select([
                'id',
                'title',
                'slug',
                'summary',
                'image_url',
                'image_tw_url',
                'image_thumb_url',
                'published_at',
                'is_highlighted',
                'created_at',
            ])
            ->simplePaginate(perPage: 6, page: $page)
            ->through(fn($post) => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'summary' => $post->getSummary(),
                'thumbnail' => $post->getThumbnailImageUrl(),
                'publishedAt' => $post->published_at->format('j F Y'),
                'categories' => $post->categories()->pluck('name'),
            ])
            ->withQueryString();

        $meta = $this->getMetaIndex('Blog posts', 'List of blog posts');

        return inertia('Post/Index', [
            'posts' => inertia()->merge(fn() => $posts->items()),
            'page' => $posts->toArray()['current_page'],
            'next_url' => $posts->toArray()['next_page_url'],
            'meta' => $meta
        ]);
    }
}
