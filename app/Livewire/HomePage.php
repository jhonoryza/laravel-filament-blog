<?php

namespace App\Livewire;

use App\Repositories\PostRepository;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class HomePage extends Component
{
    use WithPagination;
    public Collection $data;

    public int $page = 1;
    public string $search = '';
    public bool $hasMore = true;

    private int $defaultPageSize = 10 * 4;

    public $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadMore(): void
    {
        if ($this->search === '') {
            $this->page++;
            $this->refreshLoadMore('');
        }
    }

    public function mount()
    {
        $this->refresh('');
    }

    public function render()
    {
        return view('livewire.home-page', [
            'posts' => $this->data
        ]);
    }

    #[On('search')]
    public function listenSearchEvent($message)
    {
        $this->search = $message;
        $this->refresh($message);
    }

    private function refresh($search): void
    {
        $posts = !empty($search) ?
            PostRepository::new()->search(search: $search)
            : PostRepository::new()->paginate(pageSize: $this->defaultPageSize, pageNumber: $this->page);
        $this->hasMore = !empty($search) ? false : $posts->hasMorePages();
        $this->data = $posts->collect();
    }

    private function refreshLoadMore($search): void
    {
        $posts = !empty($search) ?
            PostRepository::new()->search(search: $search)
            : PostRepository::new()->paginate(pageSize: $this->defaultPageSize, pageNumber: $this->page);
        $this->hasMore = !empty($search) ? false : $posts->hasMorePages();
        $this->data = $this->data->merge($posts->collect());
    }

    public function updated($key, $value)
    {
        if ($key == 'search')
            $this->refresh($value);
    }
}
