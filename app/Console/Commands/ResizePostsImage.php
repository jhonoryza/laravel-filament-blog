<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Image;

class ResizePostsImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:resize-posts-image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resize posts image';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // $this->resizeBanner();
        $this->resizeAllPosts();
    }

    private function resizeBanner()
    {
        $path = public_path('banner.png');
         Image::load($path)
            ->fit(Fit::Max, 300, 157)
            ->save($path);
    }

    private function resizeAllPosts(): void
    {
        $posts = Post::query()
            ->whereNotNull('published_at')
            ->get();

        /** @var Post $post */
        foreach ($posts as $post) {
            $post->generateThumbnailImage();
            $post->generateTwitterImage();
        }
    }
}
