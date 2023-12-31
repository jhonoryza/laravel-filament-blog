<?php

namespace App\Livewire;

use App\Repositories\PostRepository;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class HomePage extends Component
{
    use WithPagination;
    public Collection $data;

    public int $page = 1;
    public string $search = '';
    public bool $hasMore = true;

    public $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadMore(PostRepository $postRepository): void
    {
        if ($this->search === '') {
            $this->page++;
            $posts = $postRepository->paginate(pageSize: 10, pageNumber: $this->page);
            $this->hasMore = $posts->hasMorePages();
            $this->data = $this->data->merge($posts->collect());
        }
    }

    public function mount(PostRepository $postRepository)
    {
        $posts = $postRepository->paginate(pageSize: 10, pageNumber: $this->page);
        $this->hasMore = $posts->hasMorePages();
        $this->data = $posts->collect();
    }

    public function render()
    {
        return view('livewire.home-page', [
            'posts' => $this->data
        ]);
    }

    public function updated($key, $value, PostRepository $postRepository)
    {
        if ($key === 'search' && !empty($value)) {
            $posts = $postRepository->search(search: $value);
            $this->hasMore = false;
            $this->data = $posts->collect();
        } else if ($key === 'search' && empty($value)) {
            $posts = $postRepository->paginate(pageSize: 10, pageNumber: $this->page);
            $this->hasMore = $posts->hasMorePages();
            $this->data = $posts->collect();
        }
    }
}
