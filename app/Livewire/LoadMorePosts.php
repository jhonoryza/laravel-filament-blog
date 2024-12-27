<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class LoadMorePosts extends Component
{
    use WithPagination;

    private $perPage = 10;

    #[Url(keep: true)]
    public $page = 1;

    #[Url(keep: true)]
    public $search = '';

    #[Session]
    public $posts = null;

    #[On('loadMore')]
    public function loadMore(): void
    {
        $this->page++;
        $this->loadPosts();
    }

    public function mount()
    {
        if ($this->page == 1) {
            $this->posts = null;
        }
    }

    private function getNewPosts(): Collection
    {
        return Post::query()
            ->whereNotNull('published_at')
            ->when($this->search, fn($q, $search) => $q->where('title', 'ilike', '%' . $search . '%'))
            ->latest()
            ->forPage($this->page, $this->perPage)
            ->get(['id', 'title', 'slug', 'summary', 'image_url', 'published_at', 'created_at']);
    }

    private function loadPosts(): void
    {
        $newPosts = $this->getNewPosts();
        if ($this->posts == null) {
            $this->posts = $newPosts;
            return;
        }
        $this->posts = $this->posts->merge($newPosts);
    }

    public function updatedSearch($value): void
    {
        $this->page = 1;
        $newPosts = $this->getNewPosts();
        $this->posts = $newPosts;
    }

    public function render(): View
    {
        if (is_null($this->posts)) {
            $this->loadPosts();
        }

        return view('livewire.load-more-posts');
    }
}
