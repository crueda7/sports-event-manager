<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    
    import { Head, router } from '@inertiajs/vue3';

    import { Button } from '@/components/ui/button';
    import { Label } from '@/components/ui/label';
    import { Input } from '@/components/ui/input';

    import { ref } from 'vue';

    type BreadcrumbItem = { title: string, href: string };
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Statuses', href: '/statuses' },
        { title: 'Create', href: '#' }
    ];

    const form = ref<Partial<{ name: string }>>({
        name: '',
    })

    const resetForm = () => {
        form.value = { name: '' }
    }

    const submit = () => {
        router.post('/statuses', form.value, { onSuccess: resetForm })
    }
</script>

<template>
    <Head title="Create Status"></Head>

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