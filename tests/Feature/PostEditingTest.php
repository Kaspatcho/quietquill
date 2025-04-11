<?php
// tests/Feature/PostEditingTest.php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PostEditingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can edit their own post.
     */
    public function test_user_can_edit_their_own_post()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a new post
        $post = Post::factory()->create(['user_id' => $user->id]);
        Tag::factory()->createOne();

        // Visit the post edit page
        $response = $this->get(route('posts.edit', $post->id));
        $response->assertStatus(200);

        // Edit the post using Livewire
        Livewire::test('add-post', ['post_id' => $post->id])
            ->set('title', 'Updated Title')
            ->set('body', 'Updated Body')
            ->set('tags', [1])
            ->call('save')
            ->assertRedirect(route('dashboard'));

        // Assert that the post was updated successfully
        $updated = Post::find($post->id);
        $this->assertEquals($updated->title, 'Updated Title');
        $this->assertEquals($updated->body, 'Updated Body');
    }

    /**
     * Test that a user cannot edit another user's post.
     */
    public function test_user_cannot_edit_another_users_post()
    {
        // Create two users
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Create a new post by user2
        $post = Post::factory()->create(['user_id' => $user2->id]);

        // Log in as user1
        $this->actingAs($user1);

        // Visit the post edit page
        $response = $this->get(route('posts.edit', $post->id));
        $response->assertStatus(403);
    }

    /**
     * Test that a guest user cannot edit a post.
     */
    public function test_guest_user_cannot_edit_a_post()
    {
        // Create a new post
        $post = Post::factory()->create();

        // Visit the post edit page as a guest user
        $response = $this->get(route('posts.edit', $post->id));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test that a user cannot edit a non-existent post.
     */
    public function test_user_cannot_edit_a_non_existent_post()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user);

        // Visit a non-existent post edit page
        $response = $this->get(route('posts.edit', 999));
        $response->assertStatus(404);
    }
}
