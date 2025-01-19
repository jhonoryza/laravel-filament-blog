<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Post $post)
    {
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
            ]
        ]);
    }
}
