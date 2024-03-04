<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Tool extends Model
{
    use HasTags;

    const DEV_TOOLS = 'dev tools';
    const PHP_PACKAGES = 'php packages';
    const GO_PACKAGES = 'go packages';
    const TUTORIAL = 'tutorial';

    const TYPES = [
        self::DEV_TOOLS => self::DEV_TOOLS,
        self::PHP_PACKAGES => self::PHP_PACKAGES,
        self::GO_PACKAGES => self::GO_PACKAGES,
        self::TUTORIAL => self::TUTORIAL,
    ];
}
