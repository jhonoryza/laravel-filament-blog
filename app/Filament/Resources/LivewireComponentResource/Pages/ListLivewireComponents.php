<?php

namespace App\Filament\Resources\LivewireComponentResource\Pages;

use App\Filament\Resources\LivewireComponentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLivewireComponents extends ListRecords
{
    protected static string $resource = LivewireComponentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
