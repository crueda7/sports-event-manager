<script setup lang="ts">
import { useLanguage } from '@/composables/useLanguage';
import { BookA, BookType } from 'lucide-vue-next';
import { trans } from '../helpers/translate';

interface Props {
    class?: string;
}

const { class: containerClass = '' } = defineProps<Props>();

const { language, updateLanguage } = useLanguage();

const tabs = [
    { value: 'es', Icon: BookA, label: trans('settings.language.spanish') },
    { value: 'en', Icon: BookType, label: trans('settings.language.english') },
] as const;
</script>

<template>
    <div :class="['inline-flex gap-1 rounded-lg bg-neutral-100 p-1 dark:bg-neutral-800', containerClass]">
        <button
            v-for="{ value, Icon, label } in tabs"
            :key="value"
            @click="updateLanguage(value)"
            :class="[
                'flex items-center rounded-md px-3.5 py-1.5 transition-colors',
                language === value
                    ? 'bg-white shadow-sm dark:bg-neutral-700 dark:text-neutral-100'
                    : 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60',
            ]"
        >
            <component :is="Icon" class="-ml-1 h-4 w-4" />
            <span class="ml-1.5 text-sm">{{ label }}</span>
        </button>
    </div>
</template>
