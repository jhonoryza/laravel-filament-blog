<!-- card -->
<a wire:navigate
   href="{{ route('posts.show', $post->slug) }}"
   @click="sessionStorage.setItem('scrollPosition', window.scrollY)"
   class="hover:opacity-60 flex flex-col border border-slate-100 shadow-xl rounded-xl overflow-hidden pb-2
   bg-gradient-to-br from-white via-slate-100 to-purple-50"
>
    <!-- image thumbnail -->
    <div class="w-full mx-auto flex justify-center mt-4">
        <img class="object-fill rounded-xl h-fit w-fit bg-transparent"
             src="{{ $post->getThumbnailImageUrl() }}"
             alt=""
        >
    </div>
    <!-- end image thumbnail -->

    <div class="flex flex-col justify-between px-4 gap-4">

        <!-- title -->
        <h5 class="mt-2 text-2xl font-bold tracking-tight text-slate-900">
            {{ $post->title }}
        </h5>
        <!-- end title -->

        <!-- summary -->
        @if($post->summary)
            <p class="text-base text-slate-700"> {{ $post->getSummary() }} </p>
        @endif
        <!-- end summary -->

        <!-- Tag -->
        <div class="flex flex-wrap gap-4">
            @foreach ($post->categories ?? [] as $category)
                <span class=" border border-indigo-200 rounded-lg shadow-xl
                        text-sm text-slate-700 font-medium py-1 px-2"
                >
                        {{ $category->name }}
                    </span>
            @endforeach
        </div>
        <!-- end Tag -->

        <div class="flex justify-between">
            <p class="text-sm  text-slate-900">[{{ $index }}]</p>

            <!-- published at -->
            <p class="text-sm font-medium underline  text-slate-900">
                {{ $post->created_at->format('j F Y') }}
            </p>
            <!-- end published at -->
        </div>

    </div>
</a>
<!-- end card -->
