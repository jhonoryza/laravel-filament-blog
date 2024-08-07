<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getCancelFormAction(),
            Actions\Action::make('create')
                ->label(__('filament-panels::resources/pages/create-record.form.actions.create.label'))
                ->submit(null)
                ->action('create'),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['slug'] === null) {
            $data['slug'] = Str::slug($data['title']);
        }

        return $data;
    }
}
