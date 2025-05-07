<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { trans } from '../helpers/translate';
</script>

<template>
    <div class="flex aspect-square size-8 items-center justify-center rounded-md bg-sidebar-primary text-sidebar-primary-foreground">
        <AppLogoIcon class="size-5 fill-current text-white dark:text-black" />
    </div>
    <div class="ml-1 grid flex-1 text-left text-sm">
        <span class="mb-0.5 font-semibold leading-none">{{ trans('app.name') }}</span>
    </div>
</template>
