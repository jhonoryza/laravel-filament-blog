<?php

namespace App\Livewire;

use App\Models\Post;
use Butschster\Head\Facades\Meta;
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
use Illuminate\Support\Str;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;
use Livewire\Component;
use Tempest\Highlight\CommonMark\HighlightExtension;

class PostDetailPage extends Component implements HasForms, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithInfolists;

    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;

        $title = Str::limit(ucwords($this->post->title), 60);
        $desc = Str::limit($this->post->summary ?? config('meta_tags.description.default'), 160);
        Meta::prependTitle($title)
            ->setDescription($desc);
    }

    public function render(): View
    {
        return view('livewire.post-detail-page');
    }

    public function postInfoList(Infolist $infolist): Infolist
    {
        $environment = new Environment;

        $environment
            ->addExtension(new CommonMarkCoreExtension)
            ->addExtension(new HighlightExtension)
            ->addExtension(new GithubFlavoredMarkdownExtension);

        $markdown = new MarkdownConverter($environment);

        return $infolist
            ->record($this->post)
            ->schema([
                Section::make($this->post->title)
                    ->headerActions([
                        Action::make('back')
                            ->icon('heroicon-o-chevron-left')
                            ->action(function () {
                                redirect('/');
                            }),
                    ])
                    ->icon('heroicon-s-document-text')
                    ->schema([
                        ImageEntry::make('image')
                            ->hiddenLabel()
                            ->height(120)
                            ->circular()
                            ->defaultImageUrl($this->post->getImageUrl()),
                        TextEntry::make('categories.name')
                            ->hiddenLabel()
                            ->badge()
                            ->color(Color::Teal),
                        TextEntry::make('content')
                            ->hiddenLabel()
                            ->html(true)
                            ->prose(true)
                            ->formatStateUsing(fn ($state) => $this->post->is_markdown ? $markdown->convert($state) : $state),
                    ]),
            ]);
    }
}
