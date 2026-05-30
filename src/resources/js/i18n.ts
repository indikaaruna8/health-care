import { createI18n } from 'vue-i18n';
import enOrg from './locales/en/organizations';
import frOrg from './locales/fr/organizations';

const messages: Record<'en' | 'fr', any> = {
    en: {
        organizations: enOrg,
        welcome: 'Welcome 1',
    },
    fr: {
        organizations: frOrg,
        welcome: 'Bienvenue',
    },
};

export const i18n = createI18n({
    legacy: false, // required for useI18n()
    locale: 'en',
    fallbackLocale: 'en',
    messages,
});
