<?php

namespace App\Filament\Resources\LivewireComponentResource\Pages;

use App\Filament\Resources\LivewireComponentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLivewireComponent extends EditRecord
{
    protected static string $resource = LivewireComponentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
