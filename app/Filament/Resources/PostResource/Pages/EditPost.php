<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getCancelFormAction(),
            Actions\Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit(null)
                ->action('save'),
            Actions\Action::make('preview-post')
                ->url(route('posts.show', $this->record))
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['slug'] === null) {
            $data['slug'] = Str::slug($data['title']);
        }

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if ($data['image_url'] !== null && $data['image_url'] !== $record->image_url) {
            /** @var Post $record */
            $record->generateTwitterImage();
            $record->generateThumbnailImage();
        }

        $record->update($data);
        return $record;
    }

}
