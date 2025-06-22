<script setup lang="ts">
    import Time from '@/components/time.vue';
    import Distance from '@/components/distance.vue';
    import { Activity } from '@/types/Activity';
    
    const { activity } = defineProps<{ activity: Activity }>();
</script>

<template>
    <Time :activity="activity" />
    <Distance :activity="activity" />
</template>