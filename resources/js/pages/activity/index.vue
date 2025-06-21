<script lang="ts" setup>
    import { Button } from '@/components/ui/button';
    import { Activity } from '@/types/activity';
    import { Link } from '@inertiajs/vue3';
    import Footer from '@/components/footer.vue'

    defineProps<{
        activities: Activity[];
    }>();
</script>

<template>
    <div class="min-h-screen">
        <Header class="sticky top-[0vh]" />
        <div v-for="activity in activities" :key="activity.id" class="border-border mb-4 border p-4">
            {{ activity.start }} - {{ activity.end }}
            <Button>
                <Link :href="route('activity.show', activity.id)">Ver</Link>
            </Button>
        </div>
        <Footer class="sticky top-[100vh]" />
    </div>
</template>
