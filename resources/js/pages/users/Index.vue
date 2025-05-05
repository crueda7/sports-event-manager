<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';

    import { Head, usePage, Link, router } from '@inertiajs/vue3';
    import { type BreadcrumbItem, type SharedData, type User } from '@/types';

    import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
    import { Button } from '@/components/ui/button';
    import { Pencil, Trash, CirclePlus } from 'lucide-vue-next';

    import { computed } from 'vue';

    interface UserPageProps extends SharedData {
        users: User[];
    }

    const { props } = usePage<UserPageProps>();
    const users = computed(() => props.users);
    const breadcrumbs: BreadcrumbItem[] = [{ title: 'Users', href: '/users' }];

    const deleteUser = async (id: number) => {
        if (!window.confirm('Are you sure?')) return

        router.delete(`/users/${id}`, {
            preserveScroll: true,
            onSuccess: () => {
                router.visit('/users', { replace: true });
            },
            onError: (e) => {
                console.error('Error: ', e)
            }
        });
    }
</script>


<template>
    <Head title="Users"></Head>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 rounded-xl p-4">
            <div class="flex">
                <Button as-child class="bg-blue-500 text-white hover:bg-blue-700">
                    <Link href="/users/create"> <CirclePlus /> Create </Link>
                </Button>
            </div>
        </div>

        <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min mx-4">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Id</TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Role</TableHead>
                        <TableHead>Email</TableHead>
                        <TableHead>Actions</TableHead>
                    </TableRow>
                </TableHeader>

                <TableBody>
                    <TableRow v-for="user in users" :key="user.id">
                        <TableCell>{{ user.id }}</TableCell>
                        <TableCell>{{ user.name }}</TableCell>
                        <TableCell>{{ user.role.name }}</TableCell>
                        <TableCell>{{ user.email }}</TableCell>
                        <TableCell class="flex gap-2">
                            <Button as-child size="sm" class="bg-blue-500 text-white hover:bg-blue-700">
                                <Link :href="`/users/${ user.id }/edit`">
                                    <Pencil/>
                                </Link>
                            </Button>
                            
                            <Button size="sm" class="bg-red-500 text-white hover:bg-red-700" @click="deleteUser(user.id)">
                                <Trash/>
                            </Button>
                        </TableCell>
                    </TableRow> 
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>