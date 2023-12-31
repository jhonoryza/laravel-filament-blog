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
// use Illuminate\Support\Str;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                SpatieMediaLibraryFileUpload::make('image')->collection(Post::IMAGE)->disk(config('media-library.disk_name')),
                Forms\Components\Select::make('category_id')->relationship('categories', 'name')->required()->multiple(true),
                Forms\Components\TextInput::make('title')->required()->maxLength(255),
                Forms\Components\RichEditor::make('summary')->maxLength(600),
                Forms\Components\RichEditor::make('content')->required(),
                Forms\Components\TextInput::make('slug')->nullable(),
                Forms\Components\DateTimePicker::make('published_at')->nullable(),
                Forms\Components\Select::make('author_id')->relationship('author', 'name')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('published_at')->sortable(),
                Tables\Columns\TextColumn::make('author.name'),
                Tables\Columns\TextColumn::make('created_at'),
                Tables\Columns\TextColumn::make('updated_at'),
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
