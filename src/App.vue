<template>
  <div id="content">
    <p>{{ count }}</p>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const count = ref(0)
</script>

<style scoped>
h1 {
  font-family: Ubuntu, sans-serif;
}
</style>
