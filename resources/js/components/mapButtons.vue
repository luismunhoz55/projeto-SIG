<template>
    <div class="flex flex-row justify-center gap-5">
        <button title="Iniciar" class="flex h-16 w-16 items-center justify-center rounded-xl bg-orange-500">
            <PlayIcon class="text-white-600 h-9 w-9" />
        </button>
        <button title="Encerrar" class="flex h-16 w-16 items-center justify-center rounded-xl bg-orange-500">
            <PowerIcon class="text-white-600 h-9 w-9" />
        </button>
    </div>
</template>

<script setup lang="ts">
import { PlayIcon, PowerIcon } from '@heroicons/vue/24/solid';
</script>
