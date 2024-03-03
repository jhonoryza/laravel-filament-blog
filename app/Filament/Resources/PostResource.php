<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;

// use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Laravel\Prompts\Concerns\Colors;

// use Illuminate\Support\Str;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('categories', 'name')
                    ->preload()
                    ->optionsLimit(10)
                    ->required()
                    ->multiple(true)
                    ->createOptionForm(function (Form $form) {
                        return $form
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->afterStateUpdated(function (Forms\Set $set, $state) {
                                        $set('slug', Str::slug($state));
                                    })
                                    ->lazy()
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('slug')
                                    ->required(),
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->native(false)
                                    ->required()
                            ]);
                    }),
                Forms\Components\Select::make('author_id')
                    ->relationship('author', 'name')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->lazy()
                    ->afterStateUpdated(function (Forms\Set $set, $state) {
                        $set('slug', Str::slug($state));
                    })
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')->nullable(),
                Forms\Components\Textarea::make('summary')
                    ->columnSpanFull()
                    ->maxLength(600),
                Forms\Components\Toggle::make('is_markdown')
                    ->live()
                    ->label('Convert content to Markdown'),
                Forms\Components\DateTimePicker::make('published_at')
                    ->native(false)
                    ->nullable(),
                Forms\Components\MarkdownEditor::make('content')
                    ->label('Markdown Content')
                    ->columnSpanFull()
                    ->hidden(function (Forms\Get $get) {
                        return $get('is_markdown') == false;
                    })
                    ->required(),
                Forms\Components\RichEditor::make('content')
                    ->label('Rich Text Editor Content')
                    ->columnSpanFull()
                    ->hidden(function (Forms\Get $get) {
                        return $get('is_markdown') == true;
                    })
                    ->required(),
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection(Post::IMAGE)
                    ->disk(config('media-library.disk_name')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('categories.name')
                    ->badge()
                    ->color('info'),
                Tables\Columns\ToggleColumn::make('published_at')
                    ->label('Published')
                    ->getStateUsing(function ($record) {
                        return $record->published_at ? true : false;
                    })
                    ->updateStateUsing(function ($record, $state) {
                        $record->published_at = $state ? now() : null;
                        $record->save();
                    }),
                Tables\Columns\TextColumn::make('is_markdown')
                    ->label('Markdown')
                    ->badge()
                    ->color(function ($record) {
                        return $record->is_markdown ? 'success' : 'warning';
                    })
                    ->getStateUsing(function ($record) {
                        return $record->is_markdown ? 'Yes' : 'No';
                    }),
                Tables\Columns\TextColumn::make('author.name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->toggleable()
                    ->toggledHiddenByDefault(true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->toggleable()
                    ->toggledHiddenByDefault(true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('categories', 'name'),
                Tables\Filters\Filter::make('published')
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('published_at')),
                Tables\Filters\Filter::make('unpublished')
                    ->query(fn(Builder $query): Builder => $query->whereNull('published_at')),
                Tables\Filters\Filter::make('markdown')
                    ->query(fn(Builder $query): Builder => $query->where('is_markdown', true)),
                Tables\Filters\Filter::make('date')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')->native(false),
                        Forms\Components\DatePicker::make('created_until')->native(false),
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

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('published_at', 'desc');
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
