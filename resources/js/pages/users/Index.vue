<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, usePage, Link, useForm, router } from '@inertiajs/vue3';
import { type BreadcrumbItem, type SharedData, type User } from '@/types';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import { Dialog, DialogClose, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Pencil, Trash, CirclePlus } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import { trans } from '../../helpers/translate';

const form = useForm({});
const deleteUserId = ref<number | null>(null);

interface UserPageProps extends SharedData {
    users: User[];
}

const { props } = usePage<UserPageProps>();
const users = computed(() => props.users);

const breadcrumbs: BreadcrumbItem[] = [{ title: trans('form.users.breadcrumb'), href: '/users' }];

const deleteUser = async (e: Event) => {
    e.preventDefault();

    if (!deleteUserId.value) return;

    form.delete(`/users/${deleteUserId.value}`, {
        preserveScroll: true,
        onSuccess: () => {
            router.visit('/users', { replace: true });
        },
        onError: (e) => {
            console.error('Error: ', e);
        },
    });
}
</script>

<template>
    <Head :title="trans('form.users.title')"></Head>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 rounded-xl p-4">
            <div class="flex">
                <Button as-child class="bg-blue-500 text-white hover:bg-blue-700">
                    <Link href="/users/create"> <CirclePlus /> {{ trans('actions.create') }} </Link>
                </Button>
            </div>
        </div>

        <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min mx-4">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>{{ trans('form.users.id') }}</TableHead>
                        <TableHead>{{ trans('form.users.name') }}</TableHead>
                        <TableHead>{{ trans('form.users.role') }}</TableHead>
                        <TableHead>{{ trans('form.users.email') }}</TableHead>
                        <TableHead>{{ trans('form.users.actions') }}</TableHead>
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

                            <Dialog>
                                <DialogTrigger as-child>
                                    <Button size="sm" class="bg-red-500 text-white hover:bg-red-700" @click="deleteUserId=user.id">
                                        <Trash/>
                                    </Button>
                                </DialogTrigger>
                                <DialogContent>
                                    <form class="space-y-6" @submit="deleteUser">
                                        <DialogHeader class="space-y-3">
                                            <DialogTitle>{{ trans('form.users.delete_confirmation_title') }}</DialogTitle>
                                            <DialogDescription>
                                                {{ trans('form.users.delete_confirmation_description') }}
                                            </DialogDescription>
                                        </DialogHeader>

                                        <DialogFooter class="gap-2">
                                            <DialogClose as-child>
                                                <Button variant="secondary"> {{ trans('actions.cancel') }} </Button>
                                            </DialogClose>

                                            <Button variant="destructive">
                                                <button type="submit">{{ trans('form.users.title_delete') }}</button>
                                            </Button>
                                        </DialogFooter>
                                    </form>
                                </DialogContent>
                            </Dialog>
                        </TableCell>
                    </TableRow> 
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>