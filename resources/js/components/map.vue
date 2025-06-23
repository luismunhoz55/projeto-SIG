<script setup lang="ts">
import { defineProps, watch, ref, onMounted } from 'vue';
import L from 'leaflet';
import axios from 'axios';

interface Position {
  latitude: number;
  longitude: number;
  registered_at?: string; 
}

const props = defineProps<{ positions: Position[] }>();
const mapElement = ref<HTMLElement | null>(null);

let map: L.Map;
let polyline: L.Polyline;
let marker: L.Marker | undefined;

onMounted(() => {
  if (!mapElement.value) return;

  map = L.map(mapElement.value).setView([-26.24714, -49.347279], 20);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors',
  }).addTo(map);

  polyline = L.polyline([], { color: 'blue' }).addTo(map);
});

async function updateRoute(positions: Position[]) {
  if (positions.length < 2) return;

  const coordinates = positions.map(p => [p.longitude, p.latitude]);

  try {
    const response = await axios.post(
      'https://api.openrouteservice.org/v2/directions/foot-walking/geojson',
      { coordinates },
      {
        headers: {
          Authorization: '5b3ce3597851110001cf6248ea9f9d6fbbf64650af7cb993d0a40d92',
          'Content-Type': 'application/json',
        },
      }
    );

    const geojson = response.data;
    const routeCoords = geojson.features[0].geometry.coordinates.map(
      ([lng, lat]: [number, number]) => [lat, lng]
    );

    polyline.setLatLngs(routeCoords);

    map.setView(routeCoords[routeCoords.length - 1], map.getZoom());

    if (!marker) {
      marker = L.marker(routeCoords[routeCoords.length - 1]).addTo(map).bindPopup('Você está aqui!').openPopup();
    } else {
      marker.setLatLng(routeCoords[routeCoords.length - 1]);
    }

  } catch (error) {
    console.error('Erro ao buscar rota:', error);
  }
}

watch(
  () => props.positions,
  (newPositions) => {
    updateRoute(newPositions);
  },
  { deep: true }
);
</script>

<template>
  <div ref="mapElement" class="h-[75vh] w-full rounded-sm"></div>
</template>
