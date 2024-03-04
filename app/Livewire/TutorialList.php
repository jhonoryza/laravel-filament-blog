<?php

namespace App\Livewire;

use App\Models\Tool;
use Butschster\Head\Facades\Meta;
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

class TutorialList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function mount()
    {
        Meta::prependTitle('Tutorial notes')
            ->setDescription('List of my notes on tutorial');
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(
                Tool::query()
                    ->where('type', Tool::TUTORIAL)
                    ->where('is_published', true)
            )
            ->heading('my tutorial notes')
            ->recordClasses(['hover:bg-teal-200'])
            ->recordUrl(fn($record) => $record->link)
            ->contentGrid([
                'md' => 3
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
        return view('livewire.tutorial-list');
    }
}
