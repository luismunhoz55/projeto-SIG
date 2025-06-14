<script lang="ts" setup>
import { Button } from '@/components/ui/button';
import { Activity } from '@/types/activity';
import { Link } from '@inertiajs/vue3';

defineProps<{
    activities: Activity[];
}>();
</script>

<template>
    <div v-for="activity in activities" :key="activity.id" class="border-border mb-4 border p-4">
        {{ activity.start }} - {{ activity.end }}
        <Button>
            <Link :href="route('activity.show', activity.id)">Ver</Link>
        </Button>
    </div>
</template>
