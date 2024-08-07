<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
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
}
