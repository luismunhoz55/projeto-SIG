<script setup lang="ts">
import Footer from '@/components/footer.vue';
import MapTrace from '@/components/mapTrace.vue';
import RunDescription from '@/components/runDescription.vue';
import { Activity } from '@/types/Activity';

const { activity } = defineProps<{ activity: Activity }>();
</script>

<template>
    <div class="min-h-screen space-y-4 p-5 pb-[10vh]">
        <MapTrace :activity="activity" />
        <RunDescription :activity="activity" />
        <Footer class="fixed top-[89vh] left-[50%] -translate-x-1/2" />
    </div>
</template>
