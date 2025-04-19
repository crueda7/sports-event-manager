<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';

    import { Head, usePage, router } from '@inertiajs/vue3';
    import { Status } from '@/types';

    import { Button } from '@/components/ui/button';
    import { Label } from '@/components/ui/label';
    import { Input } from '@/components/ui/input';

    import { onMounted, reactive } from 'vue';

    type BreadcrumbItem = { title: string, href: string };
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Statuses', href: '/statuses' },
        { title: 'Edit', href: '#' }
    ];

    const { props } = usePage();
    const status = props.status as Status;

    const form = reactive<Partial<{ name: string }>>({
        name: '',
    })

    onMounted(() => {
        form.name = status.name ?? '';
    })

    const resetForm = () => {
        form.name = '';
    }

    const submit = () => {
        router.put(`/statuses/${status.id}`, form, { onSuccess: resetForm })
    }
</script>

<template>
    <Head title="Edit Status"></Head>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-4 rounded-xl p-4">
            <form @submit.prevent="submit" class="space-y-6 max-w-lg">
                <div v-for="(label, key) in {name: 'Name'}" :key="key" class="space-y-2">
                    <Label :for="key">{{ label }}</Label>
                    <Input :id="key" v-model="form[key]" :type="'text'" :placeholder="label" :required="true">{{ label }}</Input>
                </div>

                <div class="flex gap-2">
                    <Button type="submit" class="bg-blue-500 text-white hover:bg-blue-700">Save</Button>
                    <Button as="a" href="/statuses" variant="outline">Cancel</Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>