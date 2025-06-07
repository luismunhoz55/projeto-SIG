<template>
    <div class="flex flex-col items-center gap-4">
        <div class="flex h-[10vh] w-full items-center justify-center rounded-sm border border-orange-600 bg-orange-700 p-5 text-center text-white">
            <template v-if="error">
                {{ error }}
            </template>
            <template v-if="loading"> Obtendo localização... </template>
            <template v-if="address">
                {{ address }}
            </template>
        </div>
        <div class="flex items-center gap-4">
            <button @click="startTracking" class="text-primary-foreground rounded bg-orange-400 px-5 py-3">Iniciar</button>
            <button @click="stopTracking" class="text-primary-foreground rounded bg-orange-400 px-5 py-3">Parar</button>
        </div>
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';

const loading = ref(false);
const error = ref('');
const address = ref('');
const watchId = ref<number>();

const startTracking = () => {
    if (!navigator.geolocation) {
        alert('Geolocalização não suportada.');
        return;
    }

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
