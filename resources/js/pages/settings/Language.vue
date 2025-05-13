<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import LanguageTabs from '@/components/LanguageTabs.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { type BreadcrumbItem } from '@/types';

import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { trans } from '../../helpers/translate';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: trans('settings.language.breadcrumb'),
        href: '/settings/language',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head :title="trans('settings.language.breadcrumb')" />

        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall :title="trans('settings.language.title')" :description="trans('settings.language.description')" />
                <LanguageTabs />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
