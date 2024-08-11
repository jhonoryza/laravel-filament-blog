<a wire:navigate href="{{ route('posts.show', $getRecord()->slug) }}" class="flex hover:bg-teal-100">
    <img class="object-cover h-32 w-32 shrink-0" src="{{ $getRecord()->getImageUrl() }}" alt="">
    <div class="flex flex-col justify-between px-2 w-full">
        <h5 class="mt-2 text-sm font-bold tracking-tight text-gray-900">{{ $getRecord()->title }}</h5>
        <div class="flex flex-row mb-2 justify-between">
            <div>
                @foreach ($getRecord()->categories ?? [] as $category)
                    <span style="--c-50:var(--primary-50);--c-400:var(--primary-400);--c-600:var(--primary-600);"
                        class="flex-wrap fi-badge mx-2 gap-x-1 rounded-md text-xs font-medium ring-1 ring-inset px-2 py-1 fi-color-custom bg-custom-50 text-custom-600 ring-custom-600/10">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
            <p class="text-xs font-bold  text-gray-500 dark:text-gray-400">
                {{ $getRecord()->created_at->format('F j, Y') }}</p>
        </div>
    </div>
</a>
