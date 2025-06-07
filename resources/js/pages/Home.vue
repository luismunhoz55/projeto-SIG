<template>
    <div class="flex min-h-screen flex-col gap-5 p-5">
        <Header />
        <Map />
        <!-- <Footer class="fixed bottom-0 left-0 mt-auto w-full" /> -->
    </div>
</template>

<script setup lang="ts">
import Header from '@/components/header.vue';
import Map from '@/components/map.vue';
</script>
