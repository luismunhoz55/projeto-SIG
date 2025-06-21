<template>
  <div class="h-[80vh] w-full" ref="mapElement"></div>
</template>

<script setup lang="ts">
import { onMounted, ref, watch } from 'vue';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import { Position } from '@/types/position';
import axios from 'axios';

interface Activity {
  id: string;
  positions: Position[];
  start: string;
  end: string;
  duration: number;
  distance: number | null;
  created_at: string;
  updated_at: string;
}

const props = defineProps<{
  activity: Activity;
}>();

const mapElement = ref<HTMLElement | null>(null);
let map: L.Map | null = null;
let polyline: L.Polyline | null = null;

const initializeMap = () => {
  if (!mapElement.value || !props.activity.positions.length) return;

  if (map) {
    map.remove();
  }

  const first = props.activity.positions[0];
  map = L.map(mapElement.value).setView([first.latitude, first.longitude], 13);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
  }).addTo(map);

  const latlngs = props.activity.positions.map(p => [p.latitude, p.longitude] as [number, number]);
  latlngs.forEach((latlng, index) => {
    L.circleMarker(latlng, {
      radius: 6,
      color: 'blue',
      fillColor: 'white',
      fillOpacity: 1,
      weight: 2,
    })
      .bindTooltip(`Point ${index + 1}`)
      .addTo(map!);
  });

  const bounds = L.latLngBounds(latlngs);
  map.fitBounds(bounds);

  updateRoute(props.activity.positions);
};

async function updateRoute(positions: Position[]) {
  if (positions.length < 2 || !map) return;

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
    const routeCoords = geojson.features[0].geometry.coordinates.map(([lng, lat]: [number, number]) => [
      lat,
      lng,
    ]);

    if (polyline) {
      polyline.remove();
    }

    polyline = L.polyline(routeCoords, {
      color: 'blue',
      weight: 4,
      opacity: 0.7,
    }).addTo(map);

    map.fitBounds(polyline.getBounds());
  } catch (error) {
    console.error('Error fetching route:', error);

    if (polyline) {
      polyline.remove();
    }

    const latlngs = positions.map(p => [p.latitude, p.longitude] as [number, number]);
    polyline = L.polyline(latlngs, {
      color: 'blue',
      weight: 4,
      opacity: 0.7,
    }).addTo(map);

    map.fitBounds(polyline.getBounds());
  }
}

onMounted(initializeMap);

watch(
  () => props.activity,
  () => {
    initializeMap();
  },
  { deep: true }
);
</script>