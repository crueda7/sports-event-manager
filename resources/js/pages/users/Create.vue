<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import { LoaderCircle } from 'lucide-vue-next';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { type SharedData, type Role } from '@/types';
import { computed } from 'vue';
import { trans } from '../../helpers/translate';

interface RolePageProps extends SharedData {
    roles: Role[];
}

const { props } = usePage<RolePageProps>();
const roles = computed(() => props.roles);

const form = useForm({
    name: '',
    email: '',
    role_id: '',
    password: '',
    password_confirmation: '',
});

type BreadcrumbItem = { title: string, href: string };
const breadcrumbs: BreadcrumbItem[] = [
    { title: trans('form.users.breadcrumb'), href: '/users' },
    { title: trans('actions.create'), href: '#' }
];

const submit = () => {
    form.post(route('users.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head :title="trans('form.users.title_create')"></Head>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-4 rounded-xl p-4">
            <form @submit.prevent="submit" class="space-y-6 max-w-lg">
                <div class="space-y-2">
                    <Label for="name">{{ trans('form.users.name') }}</Label>
                    <Input id="name" type="text" tabindex="1" autocomplete="name" v-model="form.name" placeholder="Chris Doe" />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">{{ trans('form.users.email') }}</Label>
                    <Input id="email" type="email" tabindex="2" autocomplete="email" v-model="form.email" placeholder="email@example.com" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="role_id">{{ trans('form.users.role') }}</Label>
                    <Select id="role_id" tabindex="3" v-model="form.role_id">
                        <SelectTrigger class="w-full">
                            <SelectValue :placeholder="trans('form.users.select_role')" />
                        </SelectTrigger>
                        
                        <SelectContent>
                            <SelectItem v-for="rol in roles" :key="rol.id" :value="rol.id">
                                {{ rol.name }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <InputError :message="form.errors.role_id" />
                </div>

                <div class="grid gap-2">
                    <Label for="password">{{ trans('form.users.password') }}</Label>
                    <Input id="password" type="password" tabindex="4" autocomplete="new-password" v-model="form.password" placeholder="********" />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">{{ trans('form.users.password_confirmation') }}</Label>
                    <Input id="password_confirmation" type="password" tabindex="5" autocomplete="new-password" v-model="form.password_confirmation" placeholder="********" />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <div class="flex gap-2">
                    <Button type="submit" class="bg-blue-500 text-white hover:bg-blue-700" tabindex="6" :disabled="form.processing">
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                        {{ trans('actions.save') }}
                    </Button>
                    <Button as="a" href="/users" variant="outline">{{ trans('actions.cancel') }}</Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>