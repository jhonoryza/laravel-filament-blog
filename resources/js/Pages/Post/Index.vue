<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import Base from "@/Pages/Base.vue";
import { onMounted, ref } from "vue";
import { WhenVisible } from "@inertiajs/vue3";
import { IconXboxX } from "@tabler/icons-vue";

const showFloatingButton = ref(false);

onMounted(() => {
    window.addEventListener(
        "scroll",
        () => (showFloatingButton.value = window.scrollY > 300),
    );
    setTimeout(() => {
        const scrollPosition = sessionStorage.getItem("scrollPosition") || 0;
        window.scrollTo(0, scrollPosition);
    }, 100);
});

function scrollTop() {
    window.scrollTo({ top: 0, behavior: "smooth" });
}

const props = defineProps({
    posts: Array,
    page: Number,
    next_url: String,
    meta: Array,
});

const form = useForm({
    search: "",
    page: props.page,
});

function searching() {
    form.page = 1;
    form.get(route("home"), {
        preserveState: true,
    });
}

function clearSearch() {
    form.search = "";
    form.page = 1;
    searching();
}

function goToDetail(slug) {
    sessionStorage.setItem("scrollPosition", window.scrollY);
    router.get(route("posts.show", { post: slug }));
}
</script>

<template>

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
    <Base>
    <div>
        <div class="flex flex-col gap-4 mx-4">
            <!-- search posts -->
            <form @submit.prevent="searching" class="flex items-center relative">
                <input type="text" @keyup.escape="clearSearch" v-model="form.search" placeholder="search here"
                    autocomplete="off"
                    class="form-input rounded px-1 py-1 text-sm text-slate-500 w-full focus:ring-1 focus:ring-indigo-500 dark:bg-zinc-800 dark:text-white border border-slate-500" />

                <!-- clear icon -->
                <IconXboxX v-show="form.search"
                    class="absolute right-1 size-5 text-slate-800 hover:opacity-60 hover:cursor-pointer"
                    @click="clearSearch" />
            </form>
            <!-- end search posts -->

            <!-- card -->
            <div v-for="(post, index) in posts" :key="post.id" @click="goToDetail(post.slug)"
                class="hover:opacity-60 flex flex-col border border-slate-100 shadow-xl rounded-xl hover:cursor-pointer overflow-hidden pb-2 bg-white dark:bg-zinc-800 dark:text-white">
                <!-- image thumbnail -->
                <div class="w-full mx-auto flex justify-center mt-2">
                    <img class="object-contain rounded-xl h-32 w-32 bg-transparent" :src="post.thumbnail"
                        :alt="post.title" />
                </div>
                <!-- end image thumbnail -->

                <div class="flex flex-col justify-between px-4 gap-4">
                    <!-- title -->
                    <h5 class="mt-2 text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                        {{ post.title }}
                    </h5>
                    <!-- end title -->

                    <!-- summary -->
                    <p v-show="post.summary !== ''" class="text-base text-slate-700 dark:text-white">
                        {{ post.summary }}
                    </p>
                    <!-- end summary -->

                    <!-- Tag -->
                    <div class="flex flex-wrap gap-4">
                        <span v-for="catName in post.categories"
                            class="border border-indigo-200 rounded-lg shadow-xl text-sm text-slate-700 dark:text-white font-medium py-1 px-2">
                            {{ catName }}
                        </span>
                    </div>
                    <!-- end Tag -->

                    <div class="flex justify-between">
                        <p class="text-sm text-slate-900 dark:text-white">
                            [{{ index + 1 }}]
                        </p>

                        <!-- published at -->
                        <p class="text-sm font-medium underline text-slate-900 dark:text-white">
                            {{ post.publishedAt }}
                        </p>
                        <!-- end published at -->
                    </div>
                </div>
            </div>
            <!-- end card -->

            <WhenVisible always :params="{
                data: {
                    page: page + 1,
                },
                only: ['posts', 'page', 'next_url'],
            }">
                <template v-if="next_url === null">
                    You have reach the end
                </template>
                <template v-else>
                    <div class="loader"></div>
                </template>
            </WhenVisible>

            <!-- Floating Scroll Button to Top -->
            <button v-show="showFloatingButton" @click="scrollTop"
                class="fixed bottom-5 right-1/4 bg-indigo-100 rounded-full p-3 shadow-lg hover:opacity-60 focus:outline-none z-50"
                style="display: none">
                ⬆️
            </button>
        </div>
    </div>
    </Base>
</template>

<style scoped>
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
