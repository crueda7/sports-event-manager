<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';

    import { Head, usePage, Link, router } from '@inertiajs/vue3';
    import { type BreadcrumbItem, type SharedData, type Status } from '@/types';

    import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
    import { Button } from '@/components/ui/button';
    import { Pencil, Trash, CirclePlus } from 'lucide-vue-next';

    import { computed } from 'vue';

    interface StatusPageProps extends SharedData {
        statuses: Status[];
    }

    const { props } = usePage<StatusPageProps>();
    const statuses = computed(() => props.statuses);
    const breadcrumbs: BreadcrumbItem[] = [{ title: 'Statuses', href: '/statuses' }];

    const deleteStatus = async (id: number) => {
        if (!window.confirm('Are you sure?')) return

        router.delete(`/statuses/${id}`, {
            preserveScroll: true,
            onSuccess: () => {
                router.visit('/statuses', { replace: true });
            },
            onError: (e) => {
                console.error('Error: ', e)
            }
        });
    }
</script>


<template>
    <Head title="Statuses"></Head>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 rounded-xl p-4">
            <div class="flex">
                <Button as-child class="bg-blue-500 text-white hover:bg-blue-700">
                    <Link href="/statuses/create"> <CirclePlus /> Create </Link>
                </Button>
            </div>
        </div>

        <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min mx-4">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Id</TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Actions</TableHead>
                    </TableRow>
                </TableHeader>

                <TableBody>
                    <TableRow v-for="status in statuses" :key="status.id">
                        <TableCell>{{ status.id }}</TableCell>
                        <TableCell>{{ status.name }}</TableCell>
                        <TableCell class="flex gap-2">
                            <Button as-child size="sm" class="bg-blue-500 text-white hover:bg-blue-700">
                                <Link :href="`/statuses/${ status.id }/edit`">
                                    <Pencil/>
                                </Link>
                            </Button>
                            
                            <Button size="sm" class="bg-red-500 text-white hover:bg-red-700" @click="deleteStatus(status.id)">
                                <Trash/>
                            </Button>
                        </TableCell>
                    </TableRow> 
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>