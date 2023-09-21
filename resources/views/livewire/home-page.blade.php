    <div class="flex flex-col">
        <input type="text" wire:model.live.debounce.150ms="search" placeholder="... Search"
            class="my-2 rounded-xl shadow-xl border bg-white p-2 focus:outline-none self-center">

        <div class="flex flex-row flex-wrap justify-center">
            @foreach ($posts as $post)
                <article class="m-4 rounded-lg overflow-hidden w-3/4 sm:w-1/2 md:w-1/2 lg:w-3/12 border shadow-xl">
                    <img class="h-30 lg:h-[170px] xl:h-[200px] w-full" src="{{ $post->getImageUrl() }}" alt="{{ $post->title }}">
                    <div class="p-4">
                        <a href="{{ route('posts.show', $post) }}" wire:navigate
                            class="text-base md:text-xl font-bold hover:text-rose-500">{{ $post->title }}</a>
                        <p class="text-sm font-semibold">published {{ $post->published_at->diffForHumans() }}, by
                            {{ $post->author->name }}</p>
                        <p class="text-sm mt-4 font-normal">{{ $post->summary }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            window.onscroll = function(ev) {
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                    @this.dispatch('load-more');
                }
            };
        </script>
    @endpush
