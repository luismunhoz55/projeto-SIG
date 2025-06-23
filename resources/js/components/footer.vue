<template>
    <div class="bg-primary mx-auto flex w-fit items-center rounded-full p-1">
        <div class="flex h-full flex-row rounded-t-lg">
            <MenuButton :route="route('Home')" label="Home" :is-active="currentPage === 'Home'" :icon="Home" />
            <MenuButton :route="route('activity.index')" label="Corridas" :is-active="currentPage === 'activity/index'" :icon="List" />
        </div>
    </div>
</template>

<script setup lang="ts">
import MenuButton from '@/components/menuButton.vue';
import { usePage } from '@inertiajs/vue3';
import { Home, List } from 'lucide-vue-next';
import { computed } from 'vue';

const page = usePage();
const currentPage = computed(() => page.component);
</script>
