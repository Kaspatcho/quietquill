<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Dashboard extends Component
{
    public $search;
    private $pageSize = 15;

    public function render()
    {
        return view('livewire.dashboard')
            ->with([
                'posts' => $this->getPosts(),
            ])
            ->layout('layouts.app');
    }

    private function getPosts()
    {
        if (!$this->search) {
            return auth()
                ->user()
                ->posts()
                ->orderByDesc('updated_at')
                ->paginate($this->pageSize);
        }

        return Post::search($this->search)
            ->where('user_id', auth()->user()->id)
            ->orderByDesc('updated_at')
            ->paginate($this->pageSize);
    }
}
