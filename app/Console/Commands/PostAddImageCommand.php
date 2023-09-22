<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Console\Command;

class PostAddImageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:post-add-image-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add random image to post that does not have one';

    /**
     * Execute the console command.
     */
    public function handle(PostRepository $postRepository): void
    {
        $posts = $postRepository->getWithNoImage();
        foreach ($posts as $post) {
            $rand = rand(1, 5);
            $post->addMediaFromDisk('w' . $rand .'.jpg', 'assets')
                ->preservingOriginal()
                ->toMediaCollection(Post::IMAGE);
        }
    }
}
