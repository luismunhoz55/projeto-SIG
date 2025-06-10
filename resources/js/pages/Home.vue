<template>
    <div class="flex min-h-screen flex-col gap-5 p-5">
        <Map />

        <div class="flex items-center justify-center gap-4">
            <Button v-if="!watchId" @click="startTracking" size="icon"><Play /></Button>
            <Button v-else size="icon"><Pause /></Button>
            <Button v-if="watchId" @click="stopTracking" size="icon"><Square /></Button>
        </div>
        <Toaster rich-colors />
    </div>
</template>

<script setup lang="ts">
import Map from '@/components/map.vue';
import { Button } from '@/components/ui/button';
import { Position } from '@/types/Position';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { Pause, Play, Square } from 'lucide-vue-next';
import { ref } from 'vue';
import { toast, Toaster } from 'vue-sonner';
import 'vue-sonner/style.css';

const watchId = ref<number>();
const activityId = ref('');
const positions = ref<Position[]>([]);

const startTracking = async () => {
    if (!navigator.geolocation) {
        alert('Geolocalização não suportada.');
        return;
    }

    toast('Sessão iniciada');

    const api = axios.create({
        baseURL: 'http://127.0.0.1:8000',
    });

    const response = await api.post('/activity');

    console.log(response.data.id);

    activityId.value = response.data.id;

    watchId.value = navigator.geolocation.watchPosition(
        (pos) => {
            const { latitude, longitude } = pos.coords;
            const timestamp = new Date().toISOString();
            console.log({
                latitude,
                longitude,
                timestamp,
            });

            positions.value.push({ latitude, longitude, timestamp });
        },
        (err) => {
            console.error('Erro ao obter localização:', err);
        },
        {
            enableHighAccuracy: true,
            maximumAge: 0,
            timeout: 5000,
        },
    );
};

function stopTracking() {
    if (watchId.value) {
        navigator.geolocation.clearWatch(watchId.value);
        watchId.value = undefined;

        router.patch(
            route('activity.update', activityId.value),
            { positions: positions.value },
            {
                onSuccess: () => toast.success('Sessão encerrada!'),
            },
        );
    }
}

// Opcional: encerrar automaticamente ao fechar ou recarregar a aba
window.addEventListener('beforeunload', stopTracking);
</script>
