<template>
    <div class="flex justify-center">
      <div
        class="flex justify-center items-center bg-orange-700 text-white w-full h-[10vh] p-5 text-center border border-orange-600 rounded-sm"
      >
        <template v-if="error">
          {{ error }}
        </template>
        <template v-if="loading">
          Obtendo localização...
        </template>
        <template v-if="address">
            {{ address }}
        </template>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  
  const loading = ref(true)
  const error = ref(null)
  const address = ref('')
  
  onMounted(() => {
    if (!navigator.geolocation) {
      error.value = 'Geolocalização não suportada.'
      loading.value = false
      return
    }
  
    navigator.geolocation.getCurrentPosition(async pos => {
      try {
        const lat = pos.coords.latitude
        const lon = pos.coords.longitude
  
        const res = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json&accept-language=pt-BR`)
        const data = await res.json()
  
        const addr = data.address
        address.value = `${addr.road || ''} ${addr.house_number || ''}, ${addr.suburb || ''} - ${addr.city || addr.town || ''}. ${addr.state || ''}`.trim()
        loading.value = false
      } catch (e) {
        error.value = 'Erro ao obter endereço.'
        loading.value = false
      }
    }, err => {
      error.value = `Erro: ${err.message}`
      loading.value = false
    }, { enableHighAccuracy: true })
  })
</script>
  
  