import { ref, watchEffect } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const page = usePage();
const currentLanguage = ref('es');

watchEffect(() => {
    try {
      const locale = page.props.appLocale;
      if (typeof locale === 'string') {
        currentLanguage.value = locale;
      }
    } catch {
      // props aún no están disponibles
      currentLanguage.value = 'en';
    }
  });

export function useLanguage() {
    function updateLanguage(locale: string) {
        currentLanguage.value = locale;

        router.put(route('language.update'), { locale }, {
            preserveScroll: true,
            onSuccess: () => {
                window.location.reload();
            },
        });
    }

    return {
        language: currentLanguage,
        updateLanguage,
    };
}