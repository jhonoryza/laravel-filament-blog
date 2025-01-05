<script setup>

import Nav from "@/Pages/Nav.vue";
import Footer from "@/Pages/Footer.vue";
</script>

<template>
    <div class="dark:bg-zinc-800 dark:text-white">
        <div
            class="min-h-screen max-w-xl flex flex-col bg-white mx-auto subpixel-antialiased dark:bg-zinc-800 dark:text-white">
            <Nav/>
            <main class="grow flex flex-col">
                <div class="mt-20 grow flex flex-col justify-between">
                    <slot/>
                </div>
            </main>
            <Footer/>
        </div>
    </div>
</template>

<style scoped>

</style>
