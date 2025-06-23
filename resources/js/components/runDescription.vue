<script setup lang="ts">
import Distance from '@/components/distance.vue';
import Time from '@/components/time.vue';
import { Activity } from '@/types/Activity';

const { activity } = defineProps<{ activity: Activity }>();
</script>

<template>
    <div class="border-border flex flex-col gap-1 rounded-lg border bg-white p-2 text-lg">
        <Time :activity="activity" />
        <Distance :activity="activity" />
    </div>
</template>
