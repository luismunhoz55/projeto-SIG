<script lang="ts" setup>
import Footer from '@/components/footer.vue';
import { Button } from '@/components/ui/button';
import { Activity } from '@/types/Activity';
import { Link } from '@inertiajs/vue3';
import dayjs from 'dayjs';

defineProps<{
    activities: Activity[];
}>();
</script>

<template>
    <div class="min-h-screen bg-[#f7f8fa] p-4 pb-[10vh]">
        <h3 class="mb-4 text-center text-2xl font-bold">Todas as atividades</h3>

        <div v-for="activity in activities" :key="activity.id" class="border-border mb-4 flex items-center justify-between border bg-white p-4">
            {{ dayjs(activity.start).format('DD/MM/YYYY HH:mm') }}
            <Button>
                <Link :href="route('activity.show', activity.id)">Ver</Link>
            </Button>
        </div>
        <Footer class="fixed top-[89vh] left-[50%] -translate-x-1/2" />
    </div>
</template>
