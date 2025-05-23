<nav x-data="{
    open: false,
    close() { this.open = false },
    toggle() { this.open = !this.open }
}"
>
    <div class="
        text-center text-xl font-bold h-12 border-b fixed bg-white w-full max-w-sm z-[100]"
    >
        <div class="flex items-end justify-between items-center">

            <a href="{{ route('wire.home') }}" class="text-xl text-slate-900 hover:opacity-60" wire:navigate>Home</a>

            <!-- Mobile breadcrumb button-->
            <button x-on:click="toggle()"
                    type="button"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-slate-900 hover:opacity-60"
                    aria-controls="mobile-menu"
                    aria-expanded="false"
            >
                <span class="absolute -inset-0.5"></span>
                <span class="sr-only">Open main menu</span>
                <!--
                  Icon when menu is closed.

                  Menu open: "hidden", Menu closed: "block"
                -->
                <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
                <!--
                  Icon when menu is open.

                  Menu open: "block", Menu closed: "hidden"
                -->
                <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>

        <!-- desktop menu -->
        <!--
        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
            <div class="hidden sm:ml-6 sm:block">
                <div class="flex space-x-4">
                    <a href="{{ route('home') }}" wire:navigate
                        class="px-3 py-2 text-sm font-medium hover:text-rose-500 {{ isActive('home') }}">
                        Home
                    </a>
                    <a href="https://nuxt-blog-gamma.vercel.app/"
                        class="px-3 py-2 text-sm font-medium hover:text-rose-300" target="_blank">
                        Nuxt SSR
                    </a>
                    <a href="https://vue-blog-gules.vercel.app/"
                        class="px-3 py-2 text-sm font-medium hover:text-rose-300" target="_blank">
                        Vue SPA
                    </a>

                    <a href="{{ route('components') }}" wire:navigate
                        class="px-3 py-2 text-sm font-medium hover:text-rose-500 {{ isActive('components') }}">Components</a>
                    <a href="{{ route('devtools') }}" wire:navigate
                        class="px-3 py-2 text-sm font-medium hover:text-rose-500 {{ isActive('devtools') }}">Tools</a>

                    <div class="relative inline-block px-3 py-2 text-sm font-medium hover:text-rose-500 cursor-pointer"
                        x-data="{
                            open: false,
                            close() { this.open = false },
                            toggle() { this.open = !this.open }
                        }">
                        <div>
                            <button x-on:click="toggle()" class="{{ isActive(['packages.php', 'packages.go']) }}">
                                Packages
                            </button>
                        </div>
                        <div x-show="open" x-transition x-on:click.away="close()" style="display: none"
                            class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">
                                <a href="{{ route('packages.php') }}" wire:navigate
                                    class="text-gray-700 block px-4 py-2 text-sm hover:text-rose-500 {{ isActive('packages.php') }}">PHP
                                    Packages</a>
                                <a href="{{ route('packages.go') }}" wire:navigate
                                    class="text-gray-700 block px-4 py-2 text-sm hover:text-rose-500 {{ isActive('packages.go') }}">Go
                                    Packages</a>
                            </div>
                        </div>
                    </div>

                    <a href="https://github.com/jhonoryza" class="px-3 py-2 text-sm font-medium hover:text-rose-300"
                        target="_blank">
                        Github
                        <i class="fa-brands fa-github"></i>
                    </a>
                </div>
            </div>
        </div>
        -->

        <!-- Mobile menu, show/hide based on menu state. -->
        <div x-show="open" x-transition x-on:click.away="close()" style="display: none" class="" id="mobile-menu">
            <div class="fixed space-y-1 px-2 pb-3 pt-2 shadow rounded bg-lime-100 mt-0 w-full max-w-sm z-[100] text-left">
                <a href="{{ route('wire.home') }}" wire:navigate
                   class="block hover:bg-white px-3 py-2 text-sm font-medium
               hover:text-rose-500 {{ isActive('home') }}"
                >
                    My Articles
                </a>
                <a
                    href="https://github.com/jhonoryza"
                    class="block px-3 py-2 text-sm font-medium hover:text-rose-500"
                    target="_blank"
                >
                    My Github
                </a>
                <a
                    href="https://rb.gy/uy8nj0"
                    class="block px-3 py-2 text-sm font-medium hover:text-rose-500"
                    target="_blank"
                >
                    My Portofolio
                </a>
                <a href="{{ route('wire.packages.php') }}" wire:navigate
                   class="block px-3 py-2 text-sm font-medium hover:text-rose-500"
                >
                    Good PHP Packages
                </a>
                <a href="{{ route('wire.packages.go') }}" wire:navigate
                   class="block px-3 py-2 text-sm font-medium hover:text-rose-500"
                >
                    Good Go Packages
                </a>
                <a href="{{ route('wire.devtools') }}" wire:navigate
                   class="block hover:bg-white px-3 py-2 text-sm font-medium
               hover:text-rose-500 {{ isActive('devtools') }}"
                >
                    Good Tools
                </a>
                <a href="{{ route('wire.components') }}" wire:navigate
                   class="block hover:bg-white px-3 py-2 text-sm font-medium
               hover:text-rose-500 {{ isActive('components') }}"
                >
                    Good Components
                </a>
                <a href="{{ route('home') }}" target="_blank"
                   class="block hover:bg-white px-3 py-2 text-sm font-medium
               hover:text-rose-500 {{ isActive('home') }}"
                >
                    Home using Inertia Vue
                </a>
                <a href="https://nuxt-blog-gamma.vercel.app/"
                   class="block hover:bg-white px-3 py-2 text-sm font-medium
               hover:text-rose-500" target="_blank"
                >
                    Home using Nuxt SSR
                </a>
                <a href="https://vue-blog-gules.vercel.app/"
                   class="block hover:bg-white px-3 py-2 text-sm font-medium
               hover:text-rose-500" target="_blank"
                >
                    Home using Vue SPA
                </a>
            </div>
        </div>

    </div>

</nav>
