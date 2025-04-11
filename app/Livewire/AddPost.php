<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;

class AddPost extends Component
{
    public $id;
    public $title = 'teste titulo';
    public $tags = [];
    public $body = '# Teste' . PHP_EOL . PHP_EOL . '**teste** besta';

    public $rules = [
        'title' => 'required',
        'tags' => 'required|array|min:1',
        'tags.*' => 'required|exists:tags,id',
        'body' => 'required',
    ];

    public function mount($post_id = null)
    {
        if (!$post_id) {
            return;
        }

        $post = Post::findOrFail($post_id);
        abort_if(auth()->user()->id !== $post->user_id, 403);

        $this->id = $post->id;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->tags = $post->tags->pluck('id')->toArray();
    }

    public function render()
    {
        return view('livewire.add-post')
            ->with([
                'allTags' => Tag::all(),
            ])
            ->layout('layouts.app');
    }

    public function checkedTag($tag_id)
    {
        return in_array($tag_id, $this->tags);
    }

    public function save()
    {
        $this->validate();

        if ($this->id) {
            $post = Post::findOrFail($this->id);
            abort_if(auth()->user()->id !== $post->user_id, 403);

            $post->title = $this->title;
            $post->body = $this->body;
            $post->save();
            $post->tags()->sync($this->tags);

            return redirect(route('dashboard'));
        }

        auth()->user()->posts()->create([
            'title' => $this->title,
            'body' => $this->body
        ])->tags()->attach($this->tags);

        return redirect(route('dashboard'));
    }

    public function delete()
    {
        abort_if(!$this->id, 404);
        abort_if(auth()->user()->id !== $this->id, 403);

        Post::findOrFail($this->id)->delete();

        return redirect(route('dashboard'));
    }
}
