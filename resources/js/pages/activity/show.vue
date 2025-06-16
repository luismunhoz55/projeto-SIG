<script setup lang="ts">
import MapTrace from '@/components/mapTrace.vue';
import { Activity } from '@/types/activity';

defineProps<{
  activity: Activity;
}>();
</script>

<template>
  <div class="p-4">
    {{ activity }}
    <MapTrace :activity="activity" />
  </div>
</template>
