<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { LayoutGrid, UserRoundCog, UsersRound } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { computed } from 'vue';
import type { SharedData } from '@/types';
import { trans } from '../helpers/translate';

const { props } = usePage<SharedData>();
const role = computed(() => Number(props.auth?.role ?? null));

const mainNavItems: NavItem[] = [
    {
        title: trans('app.sidebar.dashboard'),
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: trans('app.sidebar.roles'),
        href: '/roles',
        icon: UserRoundCog,
        roles: [1],
    },
    {
        title: trans('app.sidebar.users'),
        href: '/users',
        icon: UsersRound,
        roles: [1],
    },
];

const filteredNavItems = computed(() =>
    mainNavItems.filter(item =>
        !item.roles || item.roles.includes(role.value)
    )
);
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="filteredNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
