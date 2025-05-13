<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { LayoutGrid, UserRoundCog, UsersRound } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { trans } from '../helpers/translate';

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
    },
    {
        title: trans('app.sidebar.users'),
        href: '/users',
        icon: UsersRound,
    },
];
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
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
