<script setup>
import { onMounted, ref } from "vue";
import { IconMoon, IconSun } from "@tabler/icons-vue";

// const colorMode = ref(localStorage.getItem("color-mode") || "light");
const colorMode = ref(localStorage.getItem("color-mode") || undefined);

onMounted(() => {
    if (colorMode.value === undefined) {
        colorMode.value = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        localStorage.setItem("color-mode", colorMode.value);
    }
    const rootElement = document.documentElement;
    if (colorMode.value === "light") {
        rootElement.classList.remove("dark");
    } else {
        rootElement.classList.add("dark");
    }
});

const toggleColorMode = () => {
    colorMode.value = colorMode.value === "light" ? "dark" : "light";
    localStorage.setItem("color-mode", colorMode.value);
    const rootElement = document.documentElement;
    if (colorMode.value === "light") {
        rootElement.classList.remove("dark");
    } else {
        rootElement.classList.add("dark");
    }
};
</script>

<template>
    <button
        class="inline-flex items-center p-2 focus:outline-none rounded-md"
        @click="toggleColorMode"
    >
        <IconSun
            class="size-6 text-primary-400 font-normal"
            v-if="colorMode === 'light'"
        />
        <IconMoon class="size-5 stroke-white" v-else />
    </button>
</template>
