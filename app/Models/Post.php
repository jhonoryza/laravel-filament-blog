<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Image;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model
{
    use InteractsWithMedia;

    const IMAGE = 'post_image';

    const THUMBNAIL = 'thumbnail';

    const TWITTER = 'twitter';

    const DIR = 'posts';

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getPublishedAtIso8601(): string
    {
        return $this->published_at?->toIso8601String() ?? '';
    }

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
    }

    public function getSummary(): string
    {
        return Str::excerpt($this->summary ?? '');
    }

    private function resizeImage(int $width, int $height, Fit $fit, string $type): string
    {
        $disk = Storage::disk(config('media-library.disk_name'));
        $filePath = $this->image_url;
        $fileName = basename($filePath);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = $this->slug . '.' . $extension;
        $tempPath = public_path('temp') . '/' . $newFileName;

        $fileContents = $disk->get($filePath);
        file_put_contents($tempPath, $fileContents);

        Image::load($tempPath)
            ->fit($fit, $width, $height)
            ->save($tempPath);

        $extPath = self::DIR . '/' . $type . '/' . $newFileName;
        $disk
            ->put($extPath, file_get_contents($tempPath));
        unlink($tempPath);

        return $extPath;
    }

    public function generateThumbnailImage(): void
    {
        $extPath = $this->resizeImage(600, 900, Fit::Fill, self::THUMBNAIL);
        $this->image_thumb_url = $extPath;
        $this->save();
    }

    public function generateTwitterImage(): void
    {
        $extPath = $this->resizeImage(1200, 675, Fit::Fill, self::TWITTER);
        $this->image_tw_url = $extPath;
        $this->save();
    }

    public function getTwitterImageUrl(): string
    {
        return Storage::disk(config('media-library.disk_name'))
            ->url($this->image_tw_url);
    }

    public function getThumbnailImageUrl(): string
    {
        return Storage::disk(config('media-library.disk_name'))
            ->url($this->image_thumb_url);
    }
}
