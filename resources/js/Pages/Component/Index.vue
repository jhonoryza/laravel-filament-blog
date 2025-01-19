<script setup lang="js">
import Base from "@/Pages/Base.vue";

const props = defineProps({
    components: Object
});

const gotoLink = (url) => {
    window.open(url, "_blank");
}
</script>

<template>
    <Base>
        <div class="flex flex-col space-y-1 mx-4 text-primary dark:text-slate-300">
            <h1 class="font-bold text-xl">Components</h1>
            <div class="flex flex-col space-y-2">
                <div v-for="tool in components" :key="tool.id"
                    class="border border-slate-100 shadow py-2 px-2
                    hover:cursor-pointer hover:opacity-60 rounded"
                    @click="gotoLink(tool.link)"
                >
                    <h2 class="text-lg font-medium">{{ tool.name }}</h2>
                    <div class="flex gap-2 flex-row">
                        <p v-for="style in tool.styles" :key="style.id"
                            class="py-1 px-2 shadow rounded dark:bg-slate-900 bg-lime-200 text-xs"
                        >
                        {{ style.name }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </Base>
</template>
