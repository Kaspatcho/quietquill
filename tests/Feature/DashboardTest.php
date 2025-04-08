<?php
// tests/Feature/DashboardTest.php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can view their dashboard.
     */
    public function test_user_can_view_their_dashboard()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user);

        // Visit the dashboard page
        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);

        // Assert that the dashboard is displayed correctly
        $response->assertSee('Dashboard');
    }

    /**
     * Test that a user can see their posts on the dashboard.
     */
    public function test_user_can_see_their_posts_on_the_dashboard()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a new post
        $post = Post::factory()->create(['user_id' => $user->id]);

        // Visit the dashboard page
        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);

        // Assert that the post is displayed on the dashboard
        $response->assertSee($post->title);
        $response->assertSee(\Str::limit($post->body, 50));
    }

    /**
     * Test that a guest user cannot view the dashboard.
     */
    public function test_guest_user_cannot_view_the_dashboard()
    {
        // Visit the dashboard page as a guest user
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test that a user can create a new post from the dashboard.
     */
    public function test_user_can_create_a_new_post_from_the_dashboard()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user);

        // Visit the dashboard page
        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);

        // Create a new post using Livewire
        Livewire::test('add-post')
            ->set('title', 'New Post')
            ->set('body', 'This is a new post.')
            ->call('save')
            ->assertRedirect(route('dashboard'));

        // Assert that the post was created successfully
        $post = Post::firstOrFail();
        $this->assertEquals($user->id, $post->user_id);
        $this->assertEquals('New Post', $post->title);
        $this->assertEquals('This is a new post.', $post->body);
    }
}
