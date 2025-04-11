<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tag;

class AddTag extends Component
{
    public $id;
    public $name;
    public $color;

    public $rules = [
        'name' => 'required',
        'color' => 'required|string|hex_color',
    ];

    public function mount($tag_id = null)
    {
        if (!$tag_id) {
            return;
        }

        $tag = Tag::findOrFail($tag_id);
        $this->id = $tag->id;
        $this->name = $tag->name;
        $this->color = $tag->color;
    }

    public function render()
    {
        return view('livewire.add-tag')
            ->with([
                'allTags' => Tag::all(),
            ])
            ->layout('layouts.app');
    }

    public function save()
    {
        $this->validate();

        if ($this->id) {
            Tag::findOrFail($this->id)
                ->update([
                    'name' => $this->name,
                    'color' => $this->color
                ]);

            return redirect(route('dashboard'));
        }

        Tag::create([
            'name' => $this->name,
            'color' => $this->color
        ]);

        return redirect(route('dashboard'));
    }

    public function delete()
    {
        abort_if(!$this->id, 404);
        Tag::findOrFail($this->id)->delete();

        return redirect(route('dashboard'));
    }
}
