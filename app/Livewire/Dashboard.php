<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard')
            ->with([
                'posts' => request()
                    ->user()
                    ->posts()
                    ->orderByDesc('updated_at')
                    ->get(),
            ])
            ->layout('layouts.app');
    }
}
