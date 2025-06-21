<script setup lang="ts">
import MapTrace from '@/components/mapTrace.vue';
import Footer from '@/components/footer.vue';
import { Activity } from '@/types/activity';

defineProps<{
  activity: Activity;
}>();
</script>

<template>
  <div class="min-h-screen">
    <div class="flex flex-col gap-5 p-5">
      <MapTrace :activity="activity" />
    </div>
    <Footer class="sticky top-[100vh]" />
  </div>
</template>
