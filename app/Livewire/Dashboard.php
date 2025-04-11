<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;

class Dashboard extends Component
{
    public $search;
    public $selectedTag;
    private $pageSize = 15;

    public function render()
    {
        return view('livewire.dashboard')
            ->with([
                'posts' => $this->getPosts(),
                'allTags' => Tag::all(),
            ])
            ->layout('layouts.app');
    }

    private function getPosts()
    {
        if (!$this->search || $this->selectedTag) {
            return auth()
                ->user()
                ->posts()
                ->when($this->selectedTag, function ($query) {
                    return $query->whereHas('tags', function ($query) {
                        $query->where('name', $this->selectedTag);
                    });
                })
                ->orderByDesc('updated_at')
                ->paginate($this->pageSize);
        }

        return Post::search($this->search)
            ->where('user_id', auth()->user()->id)
            ->orderByDesc('updated_at')
            ->paginate($this->pageSize);
    }
}
