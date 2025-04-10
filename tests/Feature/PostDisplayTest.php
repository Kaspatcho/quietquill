<?php
// tests/Feature/PostDisplayTest.php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostDisplayTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can view their own post.
     */
    public function test_user_can_view_their_own_post()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a new post
        $post = Post::factory()->create(['user_id' => $user->id]);

        // Visit the post page
        $response = $this->get(route('posts.show', $post->id));
        $response->assertStatus(200);

        // Assert that the post is displayed correctly
        $response->assertSee($post->title);
        $response->assertSee($post->body, false);
    }

    /**
     * Test that a user can't view another user's post.
     */
    public function test_user_cannot_view_another_users_post()
    {
        // Create two users
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Create a new post by user2
        $post = Post::factory()->create(['user_id' => $user2->id]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'user_id' => $user2->id
        ]);

        // Log in as user1
        $this->actingAs($user1);

        // Visit the post page
        $response = $this->get(route('posts.show', $post->id));

        // Assert that the post is missing
        $response->assertStatus(404);
    }

    /**
     * Test that a guest user cannot view a post.
     */
    public function test_guest_user_cannot_view_a_post()
    {
        // Create a new post
        $post = Post::factory()->create();

        // Visit the post page as a guest user
        $response = $this->get(route('posts.show', $post->id));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test that a user cannot view a non-existent post.
     */
    public function test_user_cannot_view_a_non_existent_post()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user);

        // Visit a non-existent post page
        $response = $this->get(route('posts.show', 999));
        $response->assertStatus(404);
    }
}
