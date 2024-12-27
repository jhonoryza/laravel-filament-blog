@push('css')
    <style>
        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
@push('js')
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
@endpush
<div
    x-data="{ scrollPosition: sessionStorage.getItem('scrollPosition') || 0 }"
    x-init="
        if (scrollPosition) {
            window.scrollTo(0, scrollPosition);
        }
    "
>
    <div class="flex flex-col gap-4 max-w-sm mx-auto">
        <input
            type="text"
            wire:model.live.debounce="search"
            placeholder="search here"
            autocomplete="off"
            class="form-input rounded px-1 py-1 text-sm text-slate-500
                focus:outline-none focus:border-none focus:ring-1 focus:ring-indigo-500
                border border-slate-500"
        >

        @foreach ($this->posts as $key => $post)
            <x-post.card :post="$post" :index="$key"/>
        @endforeach
    </div>

    <div x-intersect.full="$wire.loadMore()" class="p-4 mx-auto">
        <div
            wire:loading
            wire:target="loadMore"
        >
            <div class="loader"></div>
        </div>
    </div>

    <!-- Tombol Floating Scroll to Top -->
    <button
        x-data="{ show: false }"
        x-init="window.addEventListener('scroll', () => show = window.scrollY > 300)"
        x-show="show"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-5 right-5 bg-indigo-100 text-white rounded-full p-3 shadow-lg
        hover:opacity-60 focus:outline-none"
        style="display: none;"
    >
        ⬆️
    </button>
</div>
