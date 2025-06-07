<template>
    <div class="h-[65vh] w-full rounded-sm" ref="mapElement"></div>
    <!-- <MapButtons /> -->
</template>

<script setup lang="ts">
import L from 'leaflet';
import { onMounted, ref } from 'vue';

const mapElement = ref<HTMLElement | null>(null);

onMounted(() => {
    navigator.geolocation.getCurrentPosition((position) => {
        const { latitude, longitude } = position.coords;

        const map = L.map(mapElement.value!).setView([latitude, longitude], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map).bindPopup('Você está aqui!').openPopup();
    });
});
</script>
