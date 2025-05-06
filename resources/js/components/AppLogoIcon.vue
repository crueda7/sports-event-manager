<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :class="className" v-bind="$attrs">
        <g fill="none" stroke="currentColor" stroke-width="2">
            <rect x="6" y="8" width="36" height="34" rx="3" ry="3" />
            <path d="M6 16h36" />
            <line x1="14" y1="4" x2="14" y2="12" />
            <line x1="34" y1="4" x2="34" y2="12" />
            <circle cx="24" cy="30" r="7" />
            <path d="M24 23v14" />
            <path d="M18 30h12" />
            <path d="M20 24.5c2 2 6 2 8 0" />
            <path d="M20 35.5c2-2 6-2 8 0" />
        </g>
    </svg>
</template>
