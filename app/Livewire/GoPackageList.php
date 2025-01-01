<?php

namespace App\Livewire;

use App\Livewire\Concerns\MetaTrait;
use App\Models\Tool;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class GoPackageList extends Component implements HasTable, HasForms
{
    use InteractsWithForms;
    use InteractsWithTable;
    use MetaTrait;

    public function mount()
    {
        $this->setMetaIndex('Go Packages', 'List of go packages');
    }

    public function table(Table $table): Table
    {
        return $table
            ->view('components.tables.index')
            ->query(
                Tool::query()
                    ->where('type', Tool::GO_PACKAGES)
                    ->where('is_published', true)
            )
            ->heading('Recommend GO Packages')
            ->recordClasses(['hover:bg-teal-200 p-2'])
            ->recordUrl(fn($record) => $record->link)
            ->contentGrid([
                'md' => 2
            ])
            ->columns([
                Stack::make([
                    TextColumn::make('name')
                        ->weight(FontWeight::Bold),
                    TextColumn::make('desc')
                        ->size(TextColumn\TextColumnSize::ExtraSmall),

                ])
            ])
            ->filters([

            ])
            ->defaultPaginationPageOption(25)
            ->defaultSort('id', 'desc');
    }

    public function render(): View
    {
        return view('livewire.go-package-list');
    }
}
