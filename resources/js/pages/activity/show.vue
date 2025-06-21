<script setup lang="ts">
  import MapTrace from '@/components/mapTrace.vue';
  import Footer from '@/components/footer.vue';
  import Distance from '@/components/distance.vue';
  import Time from '@/components/time.vue';
  import { Activity } from '@/types/activity';

  const { activity } = defineProps<{ activity: Activity }>()
</script>

<template>
  <div class="min-h-screen">
    <div class="flex flex-col gap-5 p-5">
      <MapTrace :activity="activity" />
    </div>
    <Time :activity="activity" />
    <Distance :activity="activity" />
    <Footer class="sticky top-[100vh]" />
  </div>
</template>
