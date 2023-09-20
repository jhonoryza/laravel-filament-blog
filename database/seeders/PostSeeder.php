<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepository;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(PostRepository $postRepository): void
    {
        $user = User::first();
        $posts = $postRepository->getAllPosts();
        foreach ($posts as $post) {
            $itemExists = Post::whereSlug($post->slug)->first();
            if (!$itemExists) {
                Post::create([
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'summary' => $post->desc,
                    'author_id' => $user->id,
                    'content' => $post->content,
                    'published_at' => $post->date
                ]);
            }
        }
    }
}
