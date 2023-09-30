<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
// use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Post;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['slug'] === null) {
            $data['slug'] = Str::slug($data['title']);
        }

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $model = parent::handleRecordCreation($data);

        if (!$model->hasMedia(Post::IMAGE)) {
            $rand = rand(1, 5);
            $model->addMediaFromDisk('w' . $rand . '.jpg', 'assets')
                ->preservingOriginal()
                ->toMediaCollection(Post::IMAGE);
        }
        return $model;
    }
}
