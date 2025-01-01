<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class AuthorProfile extends Component
{
    public User $author;

    public function mount(User $author)
    {
        $this->author = $author;
    }

    public function render()
    {
        return view('livewire.author-profile');
    }
}
