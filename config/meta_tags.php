<?php

use Butschster\Head\MetaTags\Viewport;

return [
    /*
     * Meta title section
     */
    'title' => [
        'default' => 'Blog | Fajar SP',
        'separator' => '-',
        'max_length' => 255,
    ],

    /*
     * Meta description section
     */
    'description' => [
        'default' => 'personal blog',
        'max_length' => 255,
    ],

    /*
     * Meta keywords section
     */
    'keywords' => [
        'default' => 'laravel,livewire,filament,tailwind,svelte',
        'max_length' => 255,
    ],

    /*
     * Default packages
     *
     * Packages, that should be included everywhere
     */
    'packages' => [
        // 'jquery', 'bootstrap', ...
    ],

    'charset' => 'utf-8',
    'robots' => null,
    'viewport' => Viewport::RESPONSIVE,
    'csrf_token' => true,
];
