<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, usePage, Link, useForm, router } from '@inertiajs/vue3';
import { type BreadcrumbItem, type SharedData, type Role } from '@/types';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import { Dialog, DialogClose, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Pencil, Trash, CirclePlus } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import { trans } from '../../helpers/translate';

const form = useForm({});
const deleteRoleId = ref<number | null>(null);

interface RolePageProps extends SharedData {
    roles: Role[];
}

const { props } = usePage<RolePageProps>();
const roles = computed(() => props.roles);

const breadcrumbs: BreadcrumbItem[] = [{ title: trans('form.roles.breadcrumb'), href: '/roles' }];

const deleteRole = async (e: Event) => {
    e.preventDefault();

    if (!deleteRoleId.value) return;

    form.delete(`/roles/${deleteRoleId.value}`, {
        preserveScroll: true,
        onSuccess: () => {
            router.visit('/roles', { replace: true });
        },
        onError: (e) => {
            console.error('Error: ', e);
        },
    });
}
</script>

<template>
    <Head :title="trans('form.roles.title')"></Head>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 rounded-xl p-4">
            <div class="flex">
                <Button as-child class="bg-blue-500 text-white hover:bg-blue-700">
                    <Link href="/roles/create"> <CirclePlus /> {{ trans('actions.create') }} </Link>
                </Button>
            </div>
        </div>

        <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min mx-4">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>{{ trans('form.roles.id') }}</TableHead>
                        <TableHead>{{ trans('form.roles.name') }}</TableHead>
                        <TableHead>{{ trans('form.roles.actions') }}</TableHead>
                    </TableRow>
                </TableHeader>

                <TableBody>
                    <TableRow v-for="role in roles" :key="role.id">
                        <TableCell>{{ role.id }}</TableCell>
                        <TableCell>{{ role.name }}</TableCell>
                        <TableCell class="flex gap-2">
                            <Button as-child size="sm" class="bg-blue-500 text-white hover:bg-blue-700">
                                <Link :href="`/roles/${ role.id }/edit`">
                                    <Pencil/>
                                </Link>
                            </Button>

                            <Dialog>
                                <DialogTrigger as-child>
                                    <Button size="sm" class="bg-red-500 text-white hover:bg-red-700" @click="deleteRoleId=role.id">
                                        <Trash/>
                                    </Button>
                                </DialogTrigger>
                                <DialogContent>
                                    <form class="space-y-6" @submit="deleteRole">
                                        <DialogHeader class="space-y-3">
                                            <DialogTitle>{{ trans('form.roles.delete_confirmation_title') }}</DialogTitle>
                                            <DialogDescription>
                                                {{ trans('form.roles.delete_confirmation_description') }}
                                            </DialogDescription>
                                        </DialogHeader>

                                        <DialogFooter class="gap-2">
                                            <DialogClose as-child>
                                                <Button variant="secondary"> {{ trans('actions.cancel') }} </Button>
                                            </DialogClose>

                                            <Button variant="destructive">
                                                <button type="submit">{{ trans('form.roles.title_delete') }}</button>
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