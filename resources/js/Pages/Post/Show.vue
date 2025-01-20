<script setup>
import {Link, Head} from '@inertiajs/vue3';
import Base from "@/Pages/Base.vue";
import {onMounted, ref} from "vue";
import {renderMarkdown} from "@/Utils/markdownRenderer.js";

const props = defineProps({
    post: Object,
    meta: Array,
})

const renderedContent = ref('');

onMounted(async () => {
    renderedContent.value = await renderMarkdown(props.post.content);
})

const scrollToTop = () => {
    window.scrollTo({top: 0, behavior: "smooth"});
};
</script>

<template>
    <Base>
        <Head>
            <title>{{ meta.title }} </title>
            <meta name="description" :content="meta.desc">
            <meta name="keywords" :content="meta.keywords">
            <meta property="og:title" :content="meta.title">
            <meta property="og:type" :content="meta.og_type">
            <meta property="og:image" :content="meta.image">
            <meta property="og:description" :content="meta.desc">
            <meta property="og:url" :content="meta.og_url">
            <meta property="og:author" :content="meta.og_author">
            <meta property="og:published_time" :content="meta.og_time">
            <meta property="og:section" :content="meta.og_section">
            <meta name="twitter:title" :content="meta.title">
            <meta name="twitter:card" :content="meta.tw_card">
            <meta name="twitter:description" :content="meta.desc">
            <meta name="twitter:image" :content="meta.image">
        </Head>
        <div class="mx-4 text-lg">
            <Link :href="route('home')" class="p-2 text-primary dark:text-white rounded-lg hover:opacity-60">
                ⬅ Go Back
            </Link>
            <article v-if="post" class="flex flex-col gap-1 my-12">
                <img class="w-48 h-48 object-cover rounded-md" :src="post.thumbnail" :alt="post.title"/>
                <h1 class="mt-4 text-primary dark:text-white text-5xl font-bold">{{ post.title }}</h1>
                <span class="mt-4 text-secondary">
                    Published on: {{ post.publishedAt }}
                </span>
                <span class="mt-0 text-primary dark:text-white">Categories: {{ post.categories_name }}</span>
                <span class="mt-0 text-primary dark:text-white">Author: {{ post.author_name }}</span>
                <div
                    v-html="renderedContent"
                    :class="{
                        'mt-4 prose-lg': true,
                        'prose-p:max-w-xl prose-h1:max-w-xl prose-h2:max-w-xl': true,
                        'prose-ul:max-w-xl prose-li:max-w-xl prose-table:max-w-xl': true,
                        'prose-thead:max-w-xl prose-tbody:max-w-xl prose-pre:max-w-xl': true,
                        'prose-code:max-w-xl': true,
                        'prose-pre:m-0 prose-pre:p-0': true,
                        'prose-a:break-words prose-pre:w-full': true,
                        'prose-ul:list-square': true,
                        'prose-code:bg-lime-100 prose-code:p-1 prose-code:rounded-b': true,
                        'prose-code:text-black': true,
                        // 'prose-code:text-slate-200': post.is_markdown === false,
                    }"
                >
                </div>
            </article>
            <div class="flex justify-between">
                <Link
                    :href="route('home')"
                    class="p-2 text-primary dark:text-white rounded-lg hover:opacity-60"
                >
                    ⬅ Go Back
                </Link>
                <button
                    @click="scrollToTop"
                    class="px-4 py-2 rounded-full hover:opacity-60"
                >
                    ⬆
                </button>
            </div>
        </div>
    </Base>
</template>
