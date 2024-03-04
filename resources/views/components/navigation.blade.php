<nav class="text-center shadow p-1 text-xl font-bold">
    <a href="{{ route('home') }}" wire:navigate class="mr-4 hover:text-rose-500 {{ isActive('home') }}">Blog</a>
    <a href="{{ route('components') }}" wire:navigate class="mr-4 hover:text-rose-500 {{ isActive('components') }}">Components</a>
    <a href="{{ route('devtools') }}" wire:navigate class="mr-4 hover:text-rose-500 {{ isActive('devtools') }}">Tools</a>
    <!-- <a href="{{ route('tutorials') }}" wire:navigate class="mr-4 hover:text-rose-500">Tutorial</a> -->

    <div class="relative inline-block text-left {{ isActive(['packages.php', 'packages.go']) }}"
         x-data="{
            open: false,
            close() { this.open = false },
            toggle() { this.open = ! this.open }
         }"
    >
        <div>
            <button x-on:click="toggle()" class="mr-4 hover:text-rose-500 cursor-pointer">
                Packages
            </button>
        </div>
        <div
            x-show="open" x-transition x-on:click.away="close()"
            style="display: none"
            class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <a href="{{ route('packages.php') }}" wire:navigate
                   class="text-gray-700 block px-4 py-2 text-sm hover:text-rose-500">PHP Packages</a>
                <a href="{{ route('packages.go') }}" wire:navigate
                   class="text-gray-700 block px-4 py-2 text-sm hover:text-rose-500">Go Packages</a>
            </div>
        </div>
    </div>

    <a href="https://github.com/jhonoryza" class="mr-4 hover:text-rose-300" target="_blank">
        <i class="fa-brands fa-github"></i>
    </a>
</nav>
