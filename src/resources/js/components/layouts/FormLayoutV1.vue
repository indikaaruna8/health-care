<template>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Form Area -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <!-- Header -->
                    <div class="px-8 py-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                        <div class="flex items-center gap-3">
                            <div v-if="$slots.icon" class="p-2 bg-blue-50 rounded-xl">
                                <slot name="icon" />
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
                                    {{ formTitle }}
                                </h1>
                                <p v-if="$slots.subtitle" class="text-sm text-slate-500 mt-0.5">
                                    <slot name="subtitle" />
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content Slot -->
                    <div class="px-8 py-6">
                        <slot name="content" />
                    </div>

                    <!-- Footer Slot with default buttons -->
                    <div class="flex justify-end gap-3 px-8 py-5 border-t border-slate-200 bg-slate-50/80">
                        <slot name="footer">
                            <button v-if="showBack" type="button" @click="$emit('back')"
                                class="px-5 py-2.5 border border-slate-300 rounded-lg text-slate-700 text-sm font-medium hover:bg-slate-100 transition-all">
                                {{ t('common.back') }}
                            </button>
                            <button v-if="showCancel" type="button" @click="$emit('cancel')"
                                class="px-5 py-2.5 border border-slate-300 rounded-lg text-slate-700 text-sm font-medium hover:bg-slate-100 transition-all">
                                {{ t('common.cancel') }}
                            </button>
                            <button v-if="showSaveToDraft" type="button" @click="$emit('saveToDraft')"
                                class="px-5 py-2.5 border border-slate-300 rounded-lg text-slate-700 text-sm font-medium hover:bg-slate-100 transition-all">
                                {{ t('common.saveToDraft') }}
                            </button>
                            <button type="submit" @click="$emit('save')"
                                class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg text-sm font-medium shadow-sm hover:from-blue-700 hover:to-blue-800 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                                {{ t('common.save') }}
                            </button>
                        </slot>
                    </div>
                </div>
            </div>

            <!-- Help Sidebar -->
            <div v-if="$slots.help || $slots.helpBefore || $slots.helpAfter" class="lg:col-span-1">
                <div
                    class="sticky top-8 bg-gradient-to-br from-blue-50/40 to-indigo-50/30 rounded-2xl border border-blue-100/50 shadow-sm overflow-hidden">
                    <div v-if="$slots.helpBefore" class="p-5 pb-2 border-b border-blue-100/50 bg-white/40">
                        <slot name="helpBefore" />
                    </div>
                    <div v-if="$slots.help" class="p-6">
                        <slot name="help" />
                    </div>
                    <div v-if="$slots.helpAfter" class="p-5 pt-2 border-t border-blue-100/50">
                        <slot name="helpAfter" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { getCurrentInstance } from 'vue';

// Props
interface Props {
    formTitle: string;
    showBack?: boolean;
    showCancel?: boolean;
    showSaveToDraft?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    showBack: false,
    showCancel: true,
    showSaveToDraft: false,
});

// Emits
const emit = defineEmits<{
    (e: 'save'): void;
    (e: 'saveToDraft'): void;
    (e: 'cancel'): void;
    (e: 'back'): void;
}>();

// Safe i18n – falls back to hardcoded strings if plugin not available
const instance = getCurrentInstance();
const hasI18n = instance?.appContext.config.globalProperties.$t !== undefined;

const t = (key: string): string => {
    if (hasI18n) {
        return instance!.appContext.config.globalProperties.$t(key);
    }
    // Fallback translations
    const fallback: Record<string, string> = {
        'common.back': 'Back',
        'common.cancel': 'Cancel',
        'common.save': 'Save',
        'common.saveToDraft': 'Save to Draft',
    };
    return fallback[key] || key;
};
</script>
