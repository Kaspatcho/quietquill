<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post as PostModel;

class Post extends Component
{
    public $post;

    public function mount(string $post)
    {
        $this->post = PostModel::where('id', $post)
            ->where('user_id', auth()->user()->id)
            ->firstOrfail();
    }

    public function render()
    {
        return view('livewire.post')
            ->layout('layouts.app');
    }
}
