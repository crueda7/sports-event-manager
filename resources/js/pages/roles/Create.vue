<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Alert from '@/components/Alert.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import { LoaderCircle } from 'lucide-vue-next';
import { trans } from '../../helpers/translate';
import { showMessage } from '@/composables/useAlert';

const module = trans('form.roles.module');
const form = useForm({
    name: '',
});

type BreadcrumbItem = { title: string, href: string };
const breadcrumbs: BreadcrumbItem[] = [
    { title: trans('form.roles.breadcrumb'), href: '/roles' },
    { title: trans('actions.create'), href: '#' }
];

const createRole = async () => {  
    form.post('/roles', {
        preserveScroll: true,
        onSuccess: () => {
            showMessage({
                title: trans('messages.success'),
                description: trans('messages.success_create', {'module': module}),
                variant: 'success',
            });
        },
        onError: () => {
            showMessage({
                title: trans('messages.error'),
                description: trans('messages.error_create', {'module': module}),
                variant: 'error',
            });
        },
        onFinish: () => form.reset('name'),
    });
};
</script>

<template>
    <Head :title="trans('form.roles.title_create')"></Head>

    <AppLayout :breadcrumbs="breadcrumbs">
        <Alert />

        <div class="flex flex-1 flex-col gap-4 rounded-xl p-4">
            <form @submit.prevent="createRole" class="space-y-6 max-w-lg">
                <div class="space-y-2">
                    <Label for="name">{{ trans('form.roles.name') }}</Label>
                    <Input id="name" type="text" required tabindex="1" autocomplete="name" v-model="form.name" :placeholder="trans('form.roles.name')" />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="flex gap-2">
                    <Button type="submit" class="bg-blue-500 text-white hover:bg-blue-700" tabindex="2" :disabled="form.processing">
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                        {{ trans('actions.save') }}
                    </Button>
                    <Button as="a" href="/roles" variant="outline">{{ trans('actions.cancel') }}</Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>