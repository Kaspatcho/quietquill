<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class AddPost extends Component
{
    public $id;
    public $title = 'teste titulo';
    public $body = '# Teste' . PHP_EOL . PHP_EOL . '**teste** besta';

    public $rules = [
        'title' => 'required',
        'body' => 'required',
    ];

    public function mount($post_id = null)
    {
        if (!$post_id) {
            return;
        }

        $post = Post::where('id', $post_id)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        $this->id = $post->id;
        $this->title = $post->title;
        $this->body = $post->body;
    }

    public function render()
    {
        return view('livewire.add-post')
            ->layout('layouts.app');
    }

    public function save()
    {
        $this->validate();

        if ($this->id) {
            $post = Post::where('id', $this->id)
                ->where('user_id', auth()->user()->id)->first();
            $post->title = $this->title;
            $post->body = $this->body;
            $post->save();

            return redirect(route('dashboard'));
        }

        auth()->user()->posts()->create([
            'title' => $this->title,
            'body' => $this->body
        ]);

        return redirect(route('dashboard'));
    }

    public function delete()
    {
        if(!$this->id) {
            return;
        }

        Post::where('id', $this->id)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail()
            ->delete();

        return redirect(route('dashboard'));
    }
}
