<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Pagination\Paginator;

class PostRepository
{
    public function __construct(public Post $post)
    {

    }
    public function paginate(int $pageSize, int $pageNumber): Paginator
    {
        return $this->post->query()
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->simplePaginate($pageSize, ['*'], 'page', $pageNumber);
    }
}
