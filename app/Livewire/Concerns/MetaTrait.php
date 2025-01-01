<?php

namespace App\Livewire\Concerns;

use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;

trait MetaTrait
{
    public function setMetaIndex(string $title, string $desc): void
    {
        $og = new OpenGraphPackage('facebook');
        $og
            ->setTitle($title)
            ->setType('website')
            ->addImage(asset('banner.png'))
            ->setDescription($desc);
        Meta::registerPackage($og);

        $tw = new TwitterCardPackage('twitter');
        $tw->setTitle($title)
            ->setType('website')
            ->setDescription($desc)
            ->setImage(asset('banner.png'));
        Meta::registerPackage($tw);

        Meta::prependTitle($title)
            ->setDescription($desc)
            ->setFavicon(asset('favicon.png'))
            ->setContentType('website');
    }

    public function setMetaDetail(string $title, string $desc, string $imageUrl, string $keywords): void
    {
        $og = new OpenGraphPackage('facebook');
        $og
            ->setTitle($title)
            ->setType('article')
            ->addImage($imageUrl)
            ->setDescription($desc);
        Meta::registerPackage($og);

        $tw = new TwitterCardPackage('twitter');
        $tw->setTitle($title)
            ->setType('article')
            ->setDescription($desc)
            ->setImage($imageUrl);
        Meta::registerPackage($tw);

        Meta::prependTitle($title)
            ->setDescription($desc)
            ->setKeywords($keywords)
            ->setFavicon(asset('favicon.png'))
            ->setContentType('article');
    }
}
