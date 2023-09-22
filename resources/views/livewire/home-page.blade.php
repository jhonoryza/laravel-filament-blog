    <div class="flex flex-col">
        <input type="text" wire:model.live.debounce.150ms="search" placeholder="... Search"
            class="my-2 rounded-xl shadow-xl border bg-white p-2 focus:outline-none self-center">

        <div class="flex flex-row flex-wrap justify-center">
            @foreach ($posts as $post)
                <article class="m-2 rounded-lg overflow-hidden border shadow-xl">
                    <div class="flex-initial w-64">
                        <img class="w-full h-40" src="{{ $post->getImageUrl() }}" alt="{{ $post->title }}">
                    </div>
                    <div class="p-4 flex-initial w-64">
                        <a href="{{ route('posts.show', $post) }}" wire:navigate
                            class="text-base md:text-xl font-bold hover:text-rose-500">{{ $post->title }}</a>
                        <p class="text-sm">published {{ $post->published_at->diffForHumans() }} </p>
                        <p class="text-sm"> by {{ $post->author->name }}</p>
                        <div class="mt-2 text-sm prose prose-slate prose-base max-w-none">{!! $post->summary !!}</div>
                    </div>
                </article>
            @endforeach
        </div>

        @if ($hasMore)
            <div class="mt-4 self-center">
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
