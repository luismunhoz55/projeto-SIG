<script lang="ts" setup>
import { Activity } from '@/types/activity';

defineProps<{
    activity: Activity;
}>();
</script>

<template>
    <div>
        {{ activity }}
    </div>
</template>
