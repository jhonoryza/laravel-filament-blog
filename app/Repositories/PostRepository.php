<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class PostRepository
{
    public function __construct(public Post $post)
    {

    }

    public static function new(): self
    {
        return new self(new Post());
    }
    public function paginate(int $pageSize, int $pageNumber): Paginator
    {
        return $this->post->query()
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->simplePaginate($pageSize, ['*'], 'page', $pageNumber);
    }

    public function search(string $search = ''): Collection
    {
        return $this->post->query()
            ->when(!empty($search), function (Builder $query) use ($search) {
                return $query->where('title', 'ILIKE', '%' . $search . '%');
            })
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get();
    }

    public function getWithNoImage(): Collection
    {
        return $this->post->query()->whereDoesntHave('media')->get();
    }
}
