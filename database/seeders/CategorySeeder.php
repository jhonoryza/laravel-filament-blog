<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Repositories\PostMarkdownRepository;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(PostMarkdownRepository $postRepository): void
    {
        $categories = [
            'mixed',
            'laravel',
            'docker',
            'linux'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'published_at' => now()
            ]);
        }
    }
}
