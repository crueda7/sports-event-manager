<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
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

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthBase :title="trans('auth.register.title')" :description="trans('auth.register.description')">
        <Head :title="trans('auth.register.head')" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">{{ trans('auth.register.name') }}</Label>
                    <Input id="name" type="text" autofocus :tabindex="1" autocomplete="name" v-model="form.name" placeholder="Chris Doe" />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">{{ trans('auth.register.email') }}</Label>
                    <Input id="email" type="text" :tabindex="2" autocomplete="email" v-model="form.email" placeholder="email@example.com" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="role_id">{{ trans('auth.register.role') }}</Label>
                    <Select id="role_id" :tabindex="3" v-model="form.role_id">
                        <SelectTrigger class="w-full">
                            <SelectValue :placeholder="trans('auth.register.select_role')" />
                        </SelectTrigger>
                        
                        <SelectContent>
                            <SelectItem v-for="role in roles" :key="role.id" :value="role.id">
                                {{ role.name }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    <InputError :message="form.errors.role_id" />
                </div>

                <div class="grid gap-2">
                    <Label for="password">{{ trans('auth.register.password') }}</Label>
                    <Input
                        id="password"
                        type="password"
                        :tabindex="4"
                        autocomplete="new-password"
                        v-model="form.password"
                        placeholder="********"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">{{ trans('auth.register.password_confirmation') }}</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        :tabindex="5"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="********"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <Button type="submit" class="mt-2 w-full" tabindex="6" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    {{ trans('auth.register.create_account') }}
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                {{ trans('auth.register.have_account') }}
                <TextLink :href="route('login')" class="underline underline-offset-4" :tabindex="7">{{ trans('auth.register.log_in') }}</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
