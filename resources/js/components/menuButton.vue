<template>
    <div
        @click="$emit('click')"
        class="flex h-full cursor-pointer flex-col items-center justify-center rounded-full p-2"
        :class="{ 'bg-orange-600': isActive }"
    >
        <Button variant="ghost" class="w-20 rounded-full border-none p-5">
            <Link :href="route">
                <component :is="icon" class="h-8 w-8" color="#FFF" />
            </Link>
        </Button>
        <p class="font-semibold text-white">{{ label }}</p>
    </div>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';
import { defineEmits, defineProps, FunctionalComponent } from 'vue';

defineProps<{
    route: string;
    label: string;
    isActive?: boolean;
    icon: FunctionalComponent;
}>();

defineEmits(['click']);
</script>
