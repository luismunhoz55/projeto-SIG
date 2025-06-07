<template>
    <div class="bg-orange-600 rounded-t-md h-18 flex items-center px-4">
        <div class="flex flex-row gap-4 w-full h-full">
            <button class="p-0 flex items-center justify-center h-full w-1/4 bg-orange-600 hover:bg-orange-700" @click="activeButton = 0" :class="{ 'bg-orange-700': activeButton === 0 }">
                <HomeIcon class="text-white w-10 h-full" />
            </button>
            <button class="p-0 flex items-center justify-center h-full w-1/4 bg-orange-600 hover:bg-orange-700" @click="activeButton = 1" :class="{ 'bg-orange-700': activeButton === 1 }">
                <HomeIcon class="text-white w-10 h-full" />
            </button>
            <button class="p-0 flex items-center justify-center h-full w-1/4 bg-orange-600 hover:bg-orange-700" @click="activeButton = 2" :class="{ 'bg-orange-700': activeButton === 2 }">
                <HomeIcon class="text-white w-10 h-full" />
            </button>
            <button class="p-0 flex items-center justify-center h-full w-1/4 bg-orange-600 hover:bg-orange-700" @click="activeButton = 3" :class="{ 'bg-orange-700': activeButton === 3 }">
                <HomeIcon class="text-white w-10 h-full" />
            </button>
        </div>
    </div>
</template>

<script setup>
    import { HomeIcon } from '@heroicons/vue/24/solid'
    import { ref } from 'vue'

    const activeButton = ref(0)
</script>