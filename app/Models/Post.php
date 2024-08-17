<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    const IMAGE = 'post_image';

    const THUMBNAIL = 'thumbnail';

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::IMAGE)
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->useFallbackUrl('https://source.unsplash.com/500x300?random');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion(self::THUMBNAIL)
            ->height(500)
            ->width(300);
        // ->fit(Manipulations::FIT_MAX, 500, 300);
    }

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_categories');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrl(): string
    {
        return Storage::disk(config('media-library.disk_name'))
            ->url($this->image_url);
        //return $this->getFirstMediaUrl(self::IMAGE, 'thumbnail');
    }
}
