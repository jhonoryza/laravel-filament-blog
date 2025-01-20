<script setup lang="js">
import {Head} from '@inertiajs/vue3';
import Base from "@/Pages/Base.vue";

const props = defineProps({
    tools: Object,
    meta: Array,
});

const gotoLink = (url) => {
    window.open(url, "_blank");
}
</script>

<template>
    <Base>
    <Head :title="meta.title">
        <meta name="description" :content="meta.desc">
        <meta property="og:title" :content="meta.title">
        <meta property="og:type" :content="meta.og_type">
        <meta property="og:image" :content="meta.image">
        <meta property="og:description" :content="meta.desc">
        <meta name="twitter:title" :content="meta.title">
        <meta name="twitter:card" :content="meta.tw_card">
        <meta name="twitter:description" :content="meta.desc">
        <meta name="twitter:image" :content="meta.image">
    </Head>
        <div class="flex flex-col space-y-1 mx-4 text-primary dark:text-slate-300">
            <h1 class="font-bold text-xl">DevTools</h1>
            <div class="flex flex-col space-y-2">
                <div v-for="tool in tools" :key="tool.id"
                    class="border border-slate-100 shadow py-2 px-2
                    hover:cursor-pointer hover:opacity-60 rounded"
                    @click="gotoLink(tool.link)"
                >
                    <h2 class="text-lg font-medium">{{ tool.name }}</h2>
                    <p class="text-secondary">{{ tool.desc }}</p>
                </div>
            </div>
        </div>
    </Base>
</template>
