<?php

namespace App\Livewire;

use Livewire\Component;
use Str;

class Post extends Component
{
    public $post;

    public function mount(\App\Models\Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.post')
            ->layout('layouts.app');
    }
}
