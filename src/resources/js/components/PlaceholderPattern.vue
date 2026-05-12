<script setup lang="ts">
import { useId } from 'vue';

const patternId = `pattern-${useId()}`;
</script>

<template>
    <svg
        class="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20"
        fill="none"
    >
        <defs>
            <pattern
                :id="patternId"
                x="0"
                y="0"
                width="8"
                height="8"
                patternUnits="userSpaceOnUse"
            >
                <path d="M-1 5L5 -1M3 9L8.5 3.5" stroke-width="0.5"></path>
            </pattern>
        </defs>
        <rect
            stroke="none"
            :fill="`url(#${patternId})`"
            width="100%"
            height="100%"
        ></rect>
    </svg>
    <div style="text-align: center;width: 100%; height: 80px; padding: 100px">
        <span class="text-sm text-neutral-500 dark:text-neutral-400">
            Placeholder Pattern
        </span>

    </div>
</template>
