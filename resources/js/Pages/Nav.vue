<script setup>
import {Link} from "@inertiajs/vue3"
import {ref} from "vue";
import ToggleDarkMode from "@/Pages/ToggleDarkMode.vue";

const breadIsOpen = ref(false);
const packageIsOpen = ref(false);

function toggleBread() {
    breadIsOpen.value = !breadIsOpen.value;
}

function closeBreadAndPackage() {
    breadIsOpen.value = false;
    packageIsOpen.value = false;
}

function togglePackage() {
    packageIsOpen.value = !packageIsOpen.value;
}

</script>

<template>
    <nav
        class="bg-white dark:bg-zinc-800 dark:text-white border-b border-zinc-300 h-14
        fixed top-0 left-0 right-0 z-50 flex flex-col justify-center items-center max-w-xl mx-auto"
    >
        <div class="container mx-auto" v-click-away="closeBreadAndPackage">
            <div class="mx-2 flex justify-between items-center gap-2">
                <Link href="/">Home</Link>
                <div class="flex items-center gap-2">
                    <ToggleDarkMode/>
                    <!-- Mobile breadcrumb button-->
                    <button @click="toggleBread"
                            type="button"
                            class="relative inline-flex items-center justify-center rounded-md p-2 text-slate-900 dark:text-white hover:opacity-60"
                            aria-controls="mobile-menu"
                            aria-expanded="false"
                    >
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!--
                          Icon when menu is closed.

                          Menu open: "hidden", Menu closed: "block"
                        -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                        <!--
                          Icon when menu is open.

                          Menu open: "block", Menu closed: "hidden"
                        -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div v-show="breadIsOpen" x-transition style="display: none" class="" id="mobile-menu">
                <div class="fixed space-y-1 px-2 pb-3 pt-2 shadow rounded bg-sky-100 dark:bg-zinc-800 dark:text-white mt-0 max-w-xl w-full z-[100]">
                    <div class="relative inline-block px-3 py-2 text-sm font-medium hover:text-rose-500 cursor-pointer">
                        <div>
                            <button @click="togglePackage" class="{{ isActive(['packages.php', 'packages.go']) }}">
                                Packages
                            </button>
                        </div>
                        <div v-show="packageIsOpen" x-transition style="display: none"
                             class="absolute left-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white dark:bg-zinc-800 dark:text-white
                                    shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                             role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                        >
                            <div class="py-1" role="none">
                                <Link :href="route('packages.php')"
                                      class="text-gray-700 block px-4 py-2 text-sm hover:text-rose-500 {{ isActive('packages.php') }}"
                                >
                                    PHP Packages
                                </Link>
                                <Link :href="route('packages.go')"
                                      class="text-gray-700 block px-4 py-2 text-sm hover:text-rose-500 {{ isActive('packages.go') }}"
                                >
                                    Go Packages
                                </Link>
                            </div>
                        </div>
                    </div>
                    <Link :href="route('components')"
                          class="block px-3 py-2 text-sm font-medium hover:text-rose-500 {{ isActive('components') }}"
                    >
                        Components
                    </Link>
                    <Link :href="route('devtools')"
                          class="block px-3 py-2 text-sm font-medium hover:text-rose-500 {{ isActive('devtools') }}"
                    >
                        Tools
                    </Link>
                    <Link href="https://nuxt-blog-gamma.vercel.app/"
                          class="block px-3 py-2 text-sm font-medium hover:text-rose-500" target="_blank"
                    >
                        Nuxt SSR
                    </Link>
                    <Link href="https://vue-blog-gules.vercel.app/"
                          class="block px-3 py-2 text-sm font-medium hover:text-rose-500" target="_blank"
                    >
                        Vue SPA
                    </Link>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>
