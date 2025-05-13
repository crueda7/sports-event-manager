<script setup lang="ts">
import { message, hideMessage } from '@/composables/useAlert';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { AlertCircle, CheckCircle2, AlertTriangle, Info } from 'lucide-vue-next';
import { computed } from 'vue';
import { trans } from '../helpers/translate';

const icons = {
    success: CheckCircle2,
    warning: AlertTriangle,
    error: AlertCircle,
    info: Info,
};

const Icon = computed(() => icons[message.variant]);
</script>

<template>
    <Dialog :open="message.show" @update:open="(val) => { if (!val) hideMessage() }">
        <DialogContent>
            <DialogHeader class="space-y-3">
                <DialogTitle class="flex items-center gap-2">
                    <component :is="Icon" class="h-5 w-5" 
                        :class="{
                            'text-green-600': message.variant === 'success',
                            'text-red-600': message.variant === 'error',
                            'text-yellow-600': message.variant === 'warning',
                            'text-blue-600': message.variant === 'info',
                        }" 
                    />
                    {{ message.title }}
                </DialogTitle>
                <p class="text-sm text-muted-foreground">{{ message.description }}</p>
            </DialogHeader>

            <DialogFooter class="gap-2">
                <Button class="bg-blue-500 text-white hover:bg-blue-700" @click="hideMessage">{{ trans('actions.close') }}</Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
