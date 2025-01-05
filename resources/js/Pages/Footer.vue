<script setup>
const weekday = [
  "Sunday",
  "Monday",
  "Tuesday",
  "Wednesday",
  "Thursday",
  "Friday",
  "Saturday",
];
const now = new Date();
const today = weekday[now.getDay()];
</script>

<template>
    <footer>
      <div class="flex flex-col sm:flex-row justify-between items-center text-secondary text-sm p-4">
        <div class="self-start">
          © Copyright 2015 Fajar SP<br/>Code snippets are
          <a
              href="https://opensource.org/licenses/MIT"
              class="hover:text-link hover:underline"
              target="_blank"
          >
            MIT licensed
          </a>
          <br/>
        </div>
        <div class="self-end">
          <i>
            Enjoy the rest of your <span>{{ today }}</span>!
          </i>
        </div>
      </div>
    </footer>
</template>

<style scoped>

</style>
