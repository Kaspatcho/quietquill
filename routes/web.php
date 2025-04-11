<?php

use App\Livewire\AddPost;
use App\Livewire\AddTag;
use App\Livewire\Dashboard;
use App\Livewire\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/post/{post}', Post::class)->name('posts.show');
    Route::get('/posts/create', AddPost::class)->name('posts.create');
    Route::get('/posts/{post_id}/edit', AddPost::class)->name('posts.edit');
    Route::get('/tags/create', AddTag::class)->name('tags.create');
    Route::get('/tags/{tag_id}/edit', AddTag::class)->name('tags.edit');
});
