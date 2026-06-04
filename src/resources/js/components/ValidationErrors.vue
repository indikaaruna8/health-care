<script setup lang="ts">
import { computed } from 'vue';

interface Props {
    errors: Record<string, string[]>;
    field: string;
}

const props = defineProps<Props>();

const fieldErrors = computed(() => props.errors[props.field] ?? []);
</script>

<template>
    <div v-if="fieldErrors.length" class="validation-errors">
        <p v-for="(error, index) in fieldErrors" :key="index"
            :class="index === 0 ? 'first-error text-red-500' : 'next-errors text-red-500'">
            {{ error }}
        </p>
    </div>
</template>
