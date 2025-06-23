<script setup lang="ts">
import { Activity } from '@/types/Activity';
import dayjs from 'dayjs';
import duration from 'dayjs/plugin/duration';

const { activity } = defineProps<{ activity: Activity }>();

dayjs.extend(duration);

const start = dayjs(activity.start);
const end = dayjs(activity.end);

const formattedTime = dayjs.duration(end.diff(start)).format('HH:mm:ss');
</script>

<template>
    <div>
        Duração: <span class="font-bold">{{ formattedTime }}</span>
    </div>
</template>
