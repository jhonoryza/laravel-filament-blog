<article>
    <p class="text-2xl font-bold">{{ $post->title }}</p>
    <img class="h-[190px] w-auto mt-4" src="{{ $post->getImageUrl() }}" alt="{{ $post->title }}">
    <p class="text-sm mt-4 font-normal">{{ $post->published_at->format('F j, Y') }} by {{ $post->author?->name }}</p>
    <div class="mt-8 font-bold prose prose-slate prose-base max-w-none">{!!  $post->content  !!}</div>
</article>
