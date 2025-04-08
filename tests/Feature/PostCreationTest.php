<?php
// tests/Feature/PostCreationTest.php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PostCreationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can create a new post.
     */
    public function test_user_can_create_a_new_post()
    {
        // Create a user and log them in
        $this->actingAs($user = User::factory()->create());

        // Visit the post creation page
        $response = $this->get(route('posts.create'));
        $response->assertStatus(200);

        // Create a new post using Livewire
        Livewire::test('add-post')
            ->set('title', 'My New Post')
            ->set('body', 'This is my new post.')
            ->call('save')
            ->assertRedirect(route('dashboard'));


        // Assert that the post was created successfully
        $post = Post::firstOrFail();
        $this->assertEquals($user->id, $post->user_id);
        $this->assertEquals('My New Post', $post->title);
        $this->assertEquals('This is my new post.', $post->body);
    }

    /**
     * Test that a user cannot create a new post with invalid data.
     */
    public function test_user_cannot_create_a_new_post_with_invalid_data()
    {
        // Create a user and log them in
        $this->actingAs(User::factory()->create());

        // Visit the post creation page
        $response = $this->get(route('posts.create'));
        $response->assertStatus(200);

        // Attempt to create a new post with invalid data
        Livewire::test('add-post')
            ->set('title', '')
            ->set('body', '')
            ->call('save')
            ->assertHasErrors(['title', 'body']);

        // Assert that the post was not created
        $this->assertDatabaseEmpty('posts');
    }

    /**
     * Test that a guest user cannot create a new post.
     */
    public function test_guest_user_cannot_create_a_new_post()
    {
        // Visit the post creation page as a guest user
        $response = $this->get(route('posts.create'));
        $response->assertRedirect(route('login'));
    }
}
