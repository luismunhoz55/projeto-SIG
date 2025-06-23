<script setup lang="ts">
import { Activity } from '@/types/Activity';
import { Position } from '@/types/position';
import dayjs from 'dayjs';
const { activity } = defineProps<{ activity: Activity }>();

function toRadians(degrees: number): number {
    return degrees * (Math.PI / 180);
}

function haversineDistance(lat1: number, lon1: number, lat2: number, lon2: number): number {
    const R = 6371;
    const dLat = toRadians(lat2 - lat1);
    const dLon = toRadians(lon2 - lon1);
    const a = Math.sin(dLat / 2) ** 2 + Math.cos(toRadians(lat1)) * Math.cos(toRadians(lat2)) * Math.sin(dLon / 2) ** 2;

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

    return Number(distance.toFixed(2));
}

function calcularVelocidadeMediaKmH(start: Date, end: Date, positions: Position[]): number {
    const totalSeconds = dayjs(end).diff(dayjs(start), 'second');
    const distance = totalDistance(positions) * 1000;

    if (totalSeconds <= 0) return 0;

    const averageSpeed = (distance * 3.6) / totalSeconds;
    return Number(averageSpeed.toFixed(2));
}

const averageSpeed = calcularVelocidadeMediaKmH(activity.start, activity.end, activity.positions);

const totalKm = totalDistance(activity.positions);
</script>

<template>
    <div>
        Distância: <span class="font-bold">{{ totalKm }} Km</span>
    </div>
    <div>
        Velocidade média: <span class="font-bold">{{ averageSpeed }} Km/h</span>
    </div>
</template>
