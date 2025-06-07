<template>
    <div class="flex flex-row justify-center gap-5">
        <button title="Iniciar" class="w-16 h-16 rounded-xl flex justify-center items-center bg-orange-500">
            <PlayIcon class="w-9 h-9 text-white-600" />
        </button>
        <button title="Pausar" class="w-16 h-16 rounded-xl flex justify-center items-center bg-orange-500">
            <PauseIcon class="w-9 h-9 text-white-600" />
        </button>
        <button title="Encerrar" class="w-16 h-16 rounded-xl flex justify-center items-center bg-orange-500">
            <PowerIcon class="w-9 h-9 text-white-600" />
        </button>
    </div>
</template>

<script setup>
    import { PlayIcon } from '@heroicons/vue/24/solid'
    import { PauseIcon } from '@heroicons/vue/24/solid'
    import { PowerIcon } from '@heroicons/vue/24/solid'
</script>