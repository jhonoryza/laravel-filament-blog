<?php

namespace App\Livewire;

use App\Models\Tool;
use Butschster\Head\Facades\Meta;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DevToolList extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function mount()
    {
        Meta::prependTitle('Recommended Dev Tools')
            ->setDescription('List of my dev tools');
    }

    public function table(Table $table): Table
    {
        return $table
            ->view('components.tables.index')
            ->query(
                Tool::query()
                    ->where('type', Tool::DEV_TOOLS)
                    ->where('is_published', true)
            )
            ->heading('Recommend Dev Tools')
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
                    SpatieTagsColumn::make('tags')

                ])
            ])
            ->filters([

            ])
            ->defaultPaginationPageOption(25)
            ->defaultSort('id', 'desc');
    }

    public function render(): View
    {
        return view('livewire.dev-tool-list');
    }
}
