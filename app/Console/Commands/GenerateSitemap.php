<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $sitemap = SitemapGenerator::create(config('app.url'))
            ->getSitemap();
        Post::query()
            ->whereNotNull('published_at')
            ->get()->each(function ($post) use ($sitemap) {
                $sitemap->add(URL::route('posts.show', $post));
            });
        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
