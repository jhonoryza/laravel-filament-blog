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

class GoPackageList extends Component implements HasTable, HasForms
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function mount()
    {
        Meta::prependTitle('Go Packages')
            ->setDescription('List of go packages');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Tool::query()
                    ->where('type', Tool::GO_PACKAGES)
                    ->where('is_published', true)
            )
            ->heading('Recommend GO Packages')
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
        return view('livewire.go-package-list');
    }
}
