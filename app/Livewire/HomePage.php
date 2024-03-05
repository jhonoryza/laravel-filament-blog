<?php

namespace App\Livewire;

use App\Models\Post;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\View;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class HomePage extends Component implements HasActions, HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithActions;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->view('components.tables.index')
            ->query(
                Post::query()
                    ->whereNotNull('published_at')
            )
            ->heading('Articles')
            ->columns([
                Grid::make()
                    ->columns(1)
                    ->schema([
                        View::make('livewire.post-card'),
                    ])
            ])
            ->persistSearchInSession()
            ->persistFiltersInSession()
            ->defaultSort('id', 'desc')
            ->paginationPageOptions([15, 25, 50, 100])
            ->defaultPaginationPageOption(15)
            ->contentGrid([
                'sm' => 1,
                'md' => 2,
                'lg' => 3,
            ])
            ->filters([
                SelectFilter::make('category')
                    ->relationship('categories', 'name'),
                Filter::make('date')
                    ->form([
                        DatePicker::make('created_from')->native(false),
                        DatePicker::make('created_until')->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })

            ], layout: FiltersLayout::Dropdown)
            ->actions([

            ])
            ->bulkActions([

            ]);
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        return $query->simplePaginate(($this->getTableRecordsPerPage() === 'all') ? $query->count() : $this->getTableRecordsPerPage());
    }

    public function render()
    {
        return view('livewire.home-page');
    }
}
