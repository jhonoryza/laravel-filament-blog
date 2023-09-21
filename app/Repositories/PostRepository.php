<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

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

    public function getWithNoImage(): Collection
    {
        return $this->post->query()->whereDoesntHave('media')->get();
    }
}
