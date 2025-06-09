<template>
    <div class="flex min-h-screen flex-col gap-5 p-5">
        <div class="flex items-center justify-center gap-4">
            <Button @click="startTracking" size="icon"><Play /></Button>
            <Button size="icon"><Pause /></Button>
            <Button @click="stopTracking" size="icon"><Square /></Button>
        </div>

        <Map />
        <!-- <Header /> -->
        <!-- <Footer class="fixed bottom-0 left-0 mt-auto w-full" /> -->
    </div>
</template>

<script setup lang="ts">
import Map from '@/components/map.vue';
import { Button } from '@/components/ui/button';
import { router } from '@inertiajs/vue3';
import { Pause, Play, Square } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';

const { activity_id } = defineProps<{
    activity_id?: object;
}>();

const loading = ref(false);
const error = ref('');
const address = ref('');
const watchId = ref<number>();

const startTracking = async () => {
    if (!navigator.geolocation) {
        alert('Geolocalização não suportada.');
        return;
    }

    await router.post(route('activity.store'));

    console.log(activity_id);

    watchId.value = navigator.geolocation.watchPosition(
        (pos) => {
            const { latitude, longitude } = pos.coords;
            const timestamp = new Date().toISOString();
            console.log({
                latitude,
                longitude,
                timestamp,
            });
            //   coordenadas.push({ latitude, longitude, timestamp });
            //   document.getElementById("log").textContent = JSON.stringify(coordenadas, null, 2);
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
        console.log('Rastreamento encerrado.');
        // Aqui você pode salvar os dados em localStorage ou exportar para JSON, etc.
        // console.log('Coordenadas registradas:', coordenadas);
    }
}

// Opcional: encerrar automaticamente ao fechar ou recarregar a aba
window.addEventListener('beforeunload', stopTracking);

onMounted(() => {
    if (!navigator.geolocation) {
        error.value = 'Geolocalização não suportada.';
        loading.value = false;
        return;
    }

    navigator.geolocation.getCurrentPosition(
        async (pos) => {
            try {
                const lat = pos.coords.latitude;
                const lon = pos.coords.longitude;

                const res = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json&accept-language=pt-BR`);
                const data = await res.json();

                const addr = data.address;
                address.value =
                    `${addr.road || ''} ${addr.house_number || ''}, ${addr.suburb || ''} - ${addr.city || addr.town || ''}. ${addr.state || ''}`.trim();
                loading.value = false;
            } catch {
                error.value = 'Erro ao obter endereço.';
                loading.value = false;
            }
        },
        (err) => {
            error.value = `Erro: ${err.message}`;
            loading.value = false;
        },
        { enableHighAccuracy: true },
    );
});
</script>
