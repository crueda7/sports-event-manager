<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import { SharedData, User, Role } from '@/types';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import { LoaderCircle } from 'lucide-vue-next';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { computed } from 'vue';

interface UserPageProps extends SharedData {
    roles: Role[];
    user: User;
}

const { props } = usePage<UserPageProps>();
const roles = computed(() => props.roles);
const user = computed(() => props.user);

const form = useForm({
    name: user.value.name,
    email: user.value.email,
    role_id: String(user.value.role_id),
    password: '',
    password_confirmation: '',
});

type BreadcrumbItem = { title: string, href: string };
const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Users', href: '/users' },
    { title: 'Edit', href: '#' }
];

const submit = () => {
    form.put(route('users.update', user.value.id), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Edit User"></Head>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-4 rounded-xl p-4">
            <form @submit.prevent="submit" class="space-y-6 max-w-lg">
                <div class="space-y-2">
                    <Label for="name">Name</Label>
                    <Input id="name" type="text" required :tabindex="1" autocomplete="name" v-model="form.name" placeholder="Full name" />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input id="email" type="email" disabled :tabindex="2" autocomplete="email" v-model="form.email" placeholder="email@example.com" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="role_id">Role</Label>
                    <Select id="role_id" required :tabindex="3" v-model="form.role_id">
                        <SelectTrigger class="w-full">
                            <SelectValue placeholder="Select a rol" />
                        </SelectTrigger>
                        
                        <SelectContent>
                            <SelectItem v-for="role in roles" :key="role.id" :value="String(role.id)">
                                {{ role.name }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <InputError :message="form.errors.role_id" />
                </div>

                <div class="grid gap-2">
                    <Label for="password">Password</Label>
                    <Input
                        id="password"
                        type="password"
                        :tabindex="4"
                        autocomplete="new-password"
                        v-model="form.password"
                        placeholder="Password"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">Confirm password</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        :required="form.password !== '' ? true : false"
                        :tabindex="5"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="Confirm password"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <div class="flex gap-2">
                    <Button type="submit" class="bg-blue-500 text-white hover:bg-blue-700" tabindex="6" :disabled="form.processing">
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                        Save
                    </Button>
                    <Button as="a" href="/users" variant="outline">Cancel</Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>