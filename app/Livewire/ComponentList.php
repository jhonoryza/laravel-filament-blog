<?php

namespace App\Livewire;

use App\Models\LivewireComponent;
use Butschster\Head\Facades\Meta;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ComponentList extends Component implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function mount()
    {
        Meta::prependTitle('Livewire Components')
            ->setDescription('List of Livewire Components');
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->query(
                LivewireComponent::query()
                    ->where('is_published', true)
            )
            ->heading('Livewire Components')
            ->recordClasses(['hover:bg-teal-200'])
            ->recordUrl(fn ($record) => $record->link)
            ->columns([
                Stack::make([
                    TextColumn::make('name')
                        ->weight(FontWeight::Bold),
                    TextColumn::make('styles.name')
                        ->badge()
                        ->color(function ($state) {
                            return match ($state) {
                                'tailwindcss' => Color::Sky,
                                'bootstrap 4' => Color::Blue,
                                'bootstrap 5' => Color::Indigo,
                                default => Color::Yellow
                            };
                        }),
                ])
            ])
            ->filters([
                SelectFilter::make('styles')
                    ->relationship('styles', 'name')
                    ->multiple()
                    ->preload()
            ])
            ->contentGrid([
                'md' => 5
            ])
            ->defaultSort('created_at', 'desc');
    }

    public function render(): View
    {
        return view('livewire.component-list');
    }
}
