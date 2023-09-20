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

    public $listeners = [
        'load-more' => 'loadMore'
    ];

    public function mount()
    {
        $this->data = collect([]);
    }

    public function loadMore(PostRepository $postRepository): void
    {
        $this->page++;
        $posts = $postRepository->paginate(pageSize: 10, pageNumber: $this->page);
        $this->data = $this->data->merge($posts->collect());
    }

    public function render(PostRepository $postRepository)
    {
        $posts = $postRepository->paginate(pageSize: 10, pageNumber: $this->page);
        $this->data = $this->data->merge($posts->collect());

        return view('livewire.home-page', [
            'posts' => $this->data
        ]);
    }
}
