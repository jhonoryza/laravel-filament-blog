<div class="flex flex-row flex-wrap justify-center">
    @foreach ($posts as $post)
        <article class="m-4 rounded-lg overflow-hidden w-3/12 border">
            <img class="max-h-30 w-full" src="{{ $post->getImageUrl() }}"
                alt="{{ $post->title }}">
            <div class="p-4">
                <a href="{{ route('posts.show', $post) }}" wire:navigate
                    class="text-xl font-bold hover:text-rose-500">{{ $post->title }}</a>
                <p class="text-sm font-semibold">published {{ $post->published_at->diffForHumans() }}, by
                    {{ $post->author->name }}</p>
                <p class="text-sm mt-4 font-normal">{{ $post->summary }}</p>
            </div>
        </article>
    @endforeach
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
