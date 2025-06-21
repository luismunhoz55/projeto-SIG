<script setup lang="ts">
import { Activity } from '@/types/Activity';

    const { activity } = defineProps<{ activity: Activity }>()


    function toRadians(degrees: number): number {
        return degrees * (Math.PI / 180);
    }

    function haversineDistance(lat1: number, lon1: number, lat2: number, lon2: number): number {
        const R = 6371;
        const dLat = toRadians(lat2 - lat1);
        const dLon = toRadians(lon2 - lon1);
        const a =
            Math.sin(dLat / 2) ** 2 +
            Math.cos(toRadians(lat1)) * Math.cos(toRadians(lat2)) *
            Math.sin(dLon / 2) ** 2;

        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    function totalDistance(positions: { latitude: number; longitude: number }[]): number {
        let distance = 0;

        for (let i = 1; i < positions.length; i++) {
            const prev = positions[i - 1];
            const curr = positions[i];
            distance += haversineDistance(prev.latitude, prev.longitude, curr.latitude, curr.longitude);
        }

        return distance;
    }
    
    const totalKm = totalDistance(activity.positions);
</script>

<template>
    <div>
      Distância: {{ totalKm }}
    </div>
</template>