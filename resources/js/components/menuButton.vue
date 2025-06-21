<template>
    <div @click="$emit('click')" class="w-1/4 cursor-pointer flex items-center justify-center flex-col h-full">
      <Button
        class="p-5 border-none bg-orange-600 w-20 rounded-xl hover:bg-orange-700"
        :class="{ 'bg-orange-700': isActive }"
      >
        <Link :href="route">
          <HomeIcon class="text-white w-10 h-full" />
        </Link>
      </Button>
      <p class="text-white font-semibold">{{ label }}</p>
    </div>
  </template>
  
<script setup lang="ts">
    import { defineProps, defineEmits } from 'vue'
    import { Link } from '@inertiajs/vue3'
    import { Button } from '@/components/ui/button';
    import { HomeIcon } from '@heroicons/vue/24/solid'

    const props = defineProps<{
        route: string
        label: string
        isActive?: boolean
    }>()

    defineEmits(['click'])
</script>
