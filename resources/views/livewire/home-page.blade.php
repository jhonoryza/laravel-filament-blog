    <div class="flex flex-col">
        <div wire:loading>
            <p>searching data ...</p>
        </div>

        <div class="grid md:grid-cols-2">
            @foreach ($posts as $post)
                <article>
                    <div class="flex flex-col sm:flex-row justify-between text-sm mx-2">
                        <a href="{{ route('posts.show', $post) }}" wire:navigate
                            class="font-bold text-slate-600 hover:text-teal-600">{{ strtolower($post->title) }}</a>
                        <p class="text-slate-600">{{ $post->author->name }}: {{ $post->published_at->format('d F Y') }}</p>
                    </div>
                    <hr>
{{--                        <div class="mt-2 text-xs prose prose-slate prose-base max-w-none">{!! $post->summary !!}</div>--}}
                </article>
            @endforeach
        </div>

        @if ($hasMore)
            <div class="mt-4 self-center">
                <div wire:loading wire:target="loadMore">
                    loading data ...
                </div>
                <button wire:click="loadMore"
                    class="p-2 border border-slate-500 bg-white text-slate-500 hover:bg-slate-200 rounded shadow font-semibold">More
                    ... </button>
            </div>
        @endif
    </div>

    @push('scripts')
        <script type="text/javascript">
            //window.onscroll = function(ev) {
            //  if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            //    @this.dispatch('load-more');
            //}
            //};
        </script>
    @endpush
