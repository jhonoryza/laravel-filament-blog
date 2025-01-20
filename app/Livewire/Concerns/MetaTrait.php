<?php

namespace App\Livewire\Concerns;

use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Illuminate\Support\Str;

trait MetaTrait
{
    private function normalizeTitle(string $title): string
    {
        return Str::limit(ucwords($title), 70);

    }

    private function normalizeDesc(string $desc): string
    {
        return Str::limit($desc, 160);
    }

    public function setMetaIndex(string $title, string $desc): void
    {
        $title = $this->normalizeTitle($title);
        $desc = $this->normalizeDesc($desc);

        $og = new OpenGraphPackage('facebook');
        $og
            ->setTitle($title)
            ->setType('website')
            ->addImage(asset('banner.png'))
            ->setDescription($desc);
        Meta::registerPackage($og);

        $tw = new TwitterCardPackage('twitter');
        $tw->setTitle($title)
            ->setType('summary_large_image')
            ->setDescription($desc)
            ->setImage(asset('banner.png'));
        Meta::registerPackage($tw);

        Meta::setTitle($title)
            ->setDescription($desc)
            ->setFavicon(asset('favicon.png'));
    }

    public function getMetaIndex(
        string $title,
        string $desc,
    ): array
    {
        $title = $this->normalizeTitle($title);
        $desc = $this->normalizeDesc($desc);

        return [
            'title' => $title,
            'desc' => $desc,
            'image' => asset('banner.png'),
            'favicon' => asset('favicon.png'),
            'og_type' => 'website',
            'tw_card' => 'summary_large_image',
        ];
    }

    public function setMetaDetail(
        string $title,
        string $desc,
        string $url,
        string $imageUrl,
        string $keywords,
        string $author,
        string $publishedTime,
        string $section,
    ): void
    {
        $title = $this->normalizeTitle($title);
        $desc = $this->normalizeDesc($desc);

        $og = new OpenGraphPackage('facebook');
        $og
            ->setTitle($title)
            ->setType('article')
            ->addImage($imageUrl)
            ->setDescription($desc)
            ->addOgMeta('url', $url)
            ->addOgMeta('author', $author)
            ->addOgMeta('published_time', $publishedTime)
            ->addOgMeta('section', $section);
        Meta::registerPackage($og);

        $tw = new TwitterCardPackage('twitter');
        $tw->setTitle($title)
            ->setType('summary_large_image')
            ->setDescription($desc)
            ->setImage($imageUrl);
        Meta::registerPackage($tw);

        Meta::setTitle($title)
            ->setDescription($desc)
            ->setKeywords($keywords)
            ->setFavicon(asset('favicon.png'));
    }

    public function getMetaDetail(
        string $title,
        string $desc,
        string $url,
        string $imageUrl,
        string $keywords,
        string $author,
        string $publishedTime,
        string $section,
    ): array
    {
        $title = $this->normalizeTitle($title);
        $desc = $this->normalizeDesc($desc);

        return [
            'title' => $title,
            'desc' => $desc,
            'keywords' => $keywords,
            'image' => $imageUrl,
            'favicon' => asset('favicon.png'),
            'og_type' => 'article',
            'og_url' => $url,
            'og_author' => $author,
            'og_time' => $publishedTime,
            'og_section' => $section,
            'tw_card' => 'summary_large_image',
        ];
    }
}
