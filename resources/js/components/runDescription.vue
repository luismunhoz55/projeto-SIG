<script setup lang="ts">
    import Time from '@/components/time.vue';
    import Distance from '@/components/distance.vue';
    import { Activity } from '@/types/Activity';
    
    const { activity } = defineProps<{ activity: Activity }>();
</script>

<template>
    <div class="mx-5 bg-gray-100 rounded-lg p-8 flex flex-row gap-[12px] text-lg">
        <Time :activity="activity" />
        <Distance :activity="activity" />
    </div>
</template>