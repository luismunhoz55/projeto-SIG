<template>
    <div class="bg-orange-600 rounded-t-lg h-18 flex items-center">
        <div class="flex rounded-t-lg flex-row w-full h-full">
            <MenuButton
                :route="route('Home')"
                label="Home"
                :is-active="currentPage === 'Home'"
            />
            <MenuButton
                :route="route('activity.index')"
                label="Corridas"
                :is-active="currentPage === 'activity/index'"
            />
        </div>
    </div>
</template>

<script setup>
    import { computed } from 'vue'
    import MenuButton from '@/components/menuButton.vue'
    import { usePage } from '@inertiajs/vue3';

    const page = usePage();
    const currentPage = computed(() => page.component)
</script>