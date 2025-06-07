<template>
  <div class="flex flex-col min-h-screen p-5 gap-5">
    <Header></Header>
    <Map></Map>
    <Footer class="mt-auto fixed bottom-0 left-0 w-full" />
  </div>
</template>

<script setup>
  import Header from '@/components/header.vue';
  import Map from '@/components/map.vue';
  import Footer from '@/components/footer.vue';
</script>
