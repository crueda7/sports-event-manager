import { reactive } from 'vue';

export type AlertVariant = 'success' | 'warning' | 'error' | 'info';

export const message = reactive({
    title: '',
    description: '',
    variant: 'info' as AlertVariant,
    show: false,
});

export function showMessage(options: {
    title: string;
    description: string;
    variant?: 'success' | 'warning' | 'error' | 'info';
}) {
    message.title = options.title;
    message.description = options.description;
    message.variant = options.variant || 'info';
    message.show = true;
}

export function hideMessage() {
    message.title = '';
    message.description = '';
    message.variant = 'info';
    message.show = false;
}
