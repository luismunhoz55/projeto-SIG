<script setup lang="ts">
    import { Activity } from '@/types/Activity';
    import dayjs from 'dayjs'
    import duration from 'dayjs/plugin/duration'
    
    const { activity } = defineProps<{ activity: Activity }>()

    dayjs.extend(duration)

    const start = dayjs(activity.start)
    const end = dayjs(activity.end)

    const diffMs = end.diff(start)

    const dur = dayjs.duration(diffMs)

    const hours = dur.hours()
    const minutes = dur.minutes()
    const seconds = dur.seconds()

    const formattedTime = `${hours}h ${minutes}m ${seconds}s`
</script>

<template>
    Duração: {{ formattedTime }}
</template>