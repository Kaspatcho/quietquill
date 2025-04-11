<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $tags = Tag::factory()->count(5)->create();

        User::factory()
            ->has(
                Post::factory()
                    ->count(10)
                    ->afterCreating(function (Post $post) use ($tags) {
                        $post
                            ->tags()
                            ->attach(
                                $tags
                                    ->random(random_int(1, 3))
                                    ->pluck('id')
                            );
                    })
            )
            ->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('12345'),
            ]);
    }
}
