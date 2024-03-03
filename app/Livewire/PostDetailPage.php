<?php

namespace App\Livewire;

use App\Models\Post;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Support\Colors\Color;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PostDetailPage extends Component implements HasInfolists, HasForms
{
    use InteractsWithForms;
    use InteractsWithInfolists;

    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render(): View
    {
        return view('livewire.post-detail-page');
    }

    public function postInfoList(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->post)
            ->schema([
                Section::make($this->post->title)
                    ->headerActions([
                        Action::make('back')
                            ->icon('heroicon-o-chevron-left')
                            ->action(function () {
                                redirect('/');
                            })
                    ])
                    ->icon('heroicon-s-document-text')
                    ->schema([
                        ImageEntry::make('image')
                            ->hiddenLabel()
                            ->height(200)
                            ->circular()
                            ->defaultImageUrl($this->post->getImageUrl()),
                        TextEntry::make('categories.name')
                            ->hiddenLabel()
                            ->badge()
                            ->color(Color::Teal),
                        TextEntry::make('content')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->hiddenLabel()
                            ->markdown(),

                    ])
            ]);
    }
}
