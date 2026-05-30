import { createI18n } from 'vue-i18n';
import enCommon from './locales/en/common';
import frCommon from './locales/fr/common';
import enOrg from './locales/en/organizations';
import frOrg from './locales/fr/organizations';
const messages: Record<'en' | 'fr', any> = {
    en: {
        organizations: enOrg,
        common: enCommon,
        welcome: 'Welcome 1',
    },
    fr: {
        organizations: frOrg,
        common: frCommon, // Assuming French common translations are different from English
        welcome: 'Bienvenue',
    },
};

export const i18n = createI18n({
    legacy: false, // required for useI18n()
    locale: 'en',
    fallbackLocale: 'en',
    messages,
});
