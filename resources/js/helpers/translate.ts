import { usePage } from '@inertiajs/vue3';

export function trans(path: string, replacements: Record<string, string> = {}): string {
    const { translations } = usePage().props;
  
    const translation = path
        .split('.')
        .reduce((acc: any, key) => acc?.[key], translations) ?? path;
  
    return Object.keys(replacements).reduce((text, key) => {
        return text.replace(new RegExp(`:${key}`, 'g'), replacements[key]);
    }, translation);
}
