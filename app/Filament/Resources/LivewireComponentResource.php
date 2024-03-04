<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LivewireComponentResource\Pages;
use App\Filament\Resources\LivewireComponentResource\RelationManagers;
use App\Models\LivewireComponent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LivewireComponentResource extends Resource
{
    protected static ?string $model = LivewireComponent::class;

    protected static ?string $navigationGroup = 'Components';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('link')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_published')
                    ->default(true)
                    ->required(),
                Forms\Components\Select::make('style_id')
                    ->relationship('styles', 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                    ])
                    ->editOptionForm([
                        Forms\Components\TextInput::make('name')
                    ])
                    ->preload()
                    ->multiple()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('link')
                    ->url(fn ($record) => $record->link, true)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('styles.name')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLivewireComponents::route('/'),
            'create' => Pages\CreateLivewireComponent::route('/create'),
            'edit' => Pages\EditLivewireComponent::route('/{record}/edit'),
        ];
    }
}
