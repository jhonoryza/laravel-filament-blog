<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MigrateImageUrlFromPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-image-url-from-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::query()->get();
        foreach ($posts as $post) {
            if ($post->hasMedia(Post::IMAGE)) {
                $media = $post->getFirstMedia(Post::IMAGE);
                $origin = $media->id.'/'.$media->file_name;
                $fileName = 'posts/'.str($media->file_name)->prepend(now()->format('Ymd-His-'));
                Storage::disk('s3')->copy($origin, $fileName);
                $post->update([
                    'image_url' => $fileName,
                ]);
                $this->info('copied '.$post->slug);
                sleep(1);
            }
        }
    }
}
