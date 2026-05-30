Here is a redesigned form that matches the provided image, with a clean two-column layout and a help sidebar.
```vue
<template>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Form Column -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                        <!-- Header -->
                        <div class="px-8 py-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-blue-50 rounded-xl">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
                                        Organization Registration
                                    </h1>
                                    <p class="text-sm text-slate-500 mt-0.5">
                                        Register a healthcare organization within the platform.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Organization Information -->
                        <div class="px-8 pt-6 pb-4">
                            <div class="flex items-center gap-2 mb-5">
                                <span class="text-sm font-semibold text-slate-400 uppercase tracking-wider">01</span>
                                <h2 class="text-base font-semibold text-slate-800">Organization Information</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Organization Name -->
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Organization Name <span class="text-red-500">*</span>
                                    </label>
                                    <input v-model="form.name" type="text"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm" />
                                </div>

                                <!-- Slug -->
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Organization Slug
                                        <span class="text-xs text-slate-400 ml-1">(URL identifier)</span>
                                    </label>
                                    <input v-model="form.slug" type="text"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm" />
                                </div>

                                <!-- Type -->
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Organization Type <span class="text-red-500">*</span>
                                    </label>
                                    <select v-model="form.type"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm">
                                        <option value="">Select Type</option>
                                        <option value="hospital">Hospital</option>
                                        <option value="clinic">Clinic</option>
                                        <option value="startup">Startup</option>
                                        <option value="laboratory">Laboratory</option>
                                        <option value="pharmacy">Pharmacy</option>
                                    </select>
                                </div>

                                <!-- Registration Number -->
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Registration Number <span class="text-red-500">*</span>
                                    </label>
                                    <input v-model="form.registration_number" type="text"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm" />
                                </div>

                                <!-- Tax ID -->
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Tax Identification Number
                                    </label>
                                    <input v-model="form.tax_id" type="text"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm" />
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="px-8 pt-6 pb-4 border-t border-slate-100">
                            <div class="flex items-center gap-2 mb-5">
                                <span class="text-sm font-semibold text-slate-400 uppercase tracking-wider">02</span>
                                <h2 class="text-base font-semibold text-slate-800">Contact Information</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <input v-model="form.email" type="email"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm" />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <input v-model="form.phone" type="text"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm" />
                                </div>
                            </div>
                        </div>

                        <!-- Location Information -->
                        <div class="px-8 pt-6 pb-4 border-t border-slate-100">
                            <div class="flex items-center gap-2 mb-5">
                                <span class="text-sm font-semibold text-slate-400 uppercase tracking-wider">03</span>
                                <h2 class="text-base font-semibold text-slate-800">Location Information</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Address <span class="text-red-500">*</span>
                                    </label>
                                    <textarea v-model="form.address" rows="2"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm"></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        City <span class="text-red-500">*</span>
                                    </label>
                                    <input v-model="form.city" type="text"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm" />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Country <span class="text-red-500">*</span>
                                    </label>
                                    <select v-model="form.country"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm">
                                        <option value="">Select Country</option>
                                        <option value="US">United States</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="CA">Canada</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="FR">France</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Timezone
                                    </label>
                                    <select v-model="form.timezone"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm">
                                        <option value="">Select Timezone</option>
                                        <option value="America/Rankin_Inlet">America/Rankin_Inlet</option>
                                        <option value="America/New_York">Eastern Time</option>
                                        <option value="America/Chicago">Central Time</option>
                                        <option value="Europe/London">GMT</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Locale
                                    </label>
                                    <select v-model="form.locale"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm">
                                        <option value="en">English</option>
                                        <option value="fr">French (fr)</option>
                                        <option value="si">Sinhala</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Subscription Information -->
                        <div class="px-8 pt-6 pb-8 border-t border-slate-100">
                            <div class="flex items-center gap-2 mb-5">
                                <span class="text-sm font-semibold text-slate-400 uppercase tracking-wider">04</span>
                                <h2 class="text-base font-semibold text-slate-800">Subscription Information</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Plan
                                    </label>
                                    <select v-model="form.plan"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm">
                                        <option value="free">Free</option>
                                        <option value="basic">Basic</option>
                                        <option value="enterprise">Enterprise</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Subscription Status
                                    </label>
                                    <select v-model="form.subscription_status"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm">
                                        <option value="active">Active</option>
                                        <option value="trial">Trial</option>
                                        <option value="canceled">Canceled</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                        Trial End Date
                                    </label>
                                    <input v-model="form.trial_ends_at" type="date"
                                        class="w-full rounded-lg border-slate-200 bg-slate-50/40 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-200 px-4 py-2.5 text-sm" />
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end gap-3 px-8 py-5 border-t border-slate-200 bg-slate-50/80">
                            <button type="button"
                                class="px-5 py-2.5 border border-slate-300 rounded-lg text-slate-700 text-sm font-medium hover:bg-slate-100 hover:border-slate-400 transition-all duration-200">
                                Cancel
                            </button>

                            <button type="submit"
                                class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg text-sm font-medium shadow-sm hover:from-blue-700 hover:to-blue-800 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                                Save Organization
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Help Sidebar -->
                <div class="lg:col-span-1">
                    <div
                        class="sticky top-8 bg-gradient-to-br from-blue-50/40 to-indigo-50/30 rounded-2xl border border-blue-100/50 shadow-sm overflow-hidden">
                        <div class="p-5 pb-2 border-b border-blue-100/50 bg-white/40">
                            <img :src="healthImage" alt="Health Management" />
                        </div>
                        <!-- Image at the top -->
                        <div class="p-5 pb-2 border-b border-blue-100/50 bg-white/40">
                            <svg viewBox="0 0 400 160" class="w-full h-auto" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <!-- Chart / Bar graph -->
                                <rect x="20" y="80" width="30" height="60" rx="4" fill="#3B82F6" opacity="0.8" />
                                <rect x="60" y="40" width="30" height="100" rx="4" fill="#3B82F6" opacity="0.9" />
                                <rect x="100" y="60" width="30" height="80" rx="4" fill="#60A5FA" />
                                <!-- KPI 65% -->
                                <text x="145" y="105" font-family="sans-serif" font-size="24" font-weight="bold"
                                    fill="#1E293B">65%</text>
                                <text x="145" y="125" font-family="sans-serif" font-size="10" fill="#64748B">KPI</text>
                                <!-- Inventory box -->
                                <rect x="200" y="70" width="40" height="40" rx="6" fill="#FEF3C7" stroke="#F59E0B"
                                    stroke-width="1.5" />
                                <text x="210" y="95" font-family="sans-serif" font-size="10" fill="#B45309">📦</text>
                                <text x="255" y="85" font-family="sans-serif" font-size="9"
                                    fill="#64748B">Inventory</text>
                                <!-- Data Privacy/Compliance (shield) -->
                                <path
                                    d="M310 40 L310 80 C310 100 330 110 335 112 C340 110 360 100 360 80 L360 40 L335 30 L310 40Z"
                                    fill="#E0E7FF" stroke="#4F46E5" stroke-width="1.5" />
                                <text x="325" y="70" font-family="sans-serif" font-size="7" fill="#4338CA"
                                    text-anchor="middle">Compliance</text>
                                <!-- Workflow Arrows -->
                                <path d="M20 140 L70 140 L70 130 L85 145 L70 160 L70 150 L20 150 Z" fill="#10B981"
                                    opacity="0.8" />
                                <path d="M90 145 L130 145" stroke="#10B981" stroke-width="2" stroke-dasharray="4" />
                                <polygon points="128,141 138,145 128,149" fill="#10B981" />
                                <text x="100" y="140" font-family="sans-serif" font-size="8"
                                    fill="#047857">Workflow</text>
                                <!-- Dollar sign -->
                                <circle cx="370" cy="130" r="18" fill="#FEF2F2" stroke="#EF4444" stroke-width="1.5" />
                                <text x="370" y="136" font-family="sans-serif" font-size="18" font-weight="bold"
                                    fill="#DC2626" text-anchor="middle">$</text>
                            </svg>
                        </div>

                        <!-- Original help content -->
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-4">

                            </div>
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="font-semibold text-slate-800 text-lg">Need help?</h3>
                            </div>
                            <div class="space-y-4 text-sm text-slate-600">
                                <p class="text-slate-500 mb-3">Here's what you should know before registering:</p>
                                <ul class="space-y-3">
                                    <li class="flex gap-2"><span class="text-blue-500 flex-shrink-0">•</span> Ensure all
                                        required details are accurate.</li>
                                    <li class="flex gap-2"><span class="text-blue-500 flex-shrink-0">•</span>
                                        Organization details help identify your entity.</li>
                                    <li class="flex gap-2"><span class="text-blue-500 flex-shrink-0">•</span> Contact
                                        information is used for communication.</li>
                                    <li class="flex gap-2"><span class="text-blue-500 flex-shrink-0">•</span> Location
                                        settings affect your experience.</li>
                                    <li class="flex gap-2"><span class="text-blue-500 flex-shrink-0">•</span>
                                        Subscription plan can be changed later.</li>
                                </ul>
                            </div>
                            <div class="mt-6 pt-4 border-t border-blue-100">
                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>All fields marked with * are required</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup lang="ts">
import { reactive } from 'vue';
import healthImage from '@/asserts/images/helth-mangement.jpg';

const form = reactive({
    name: 'Ziemann, Larkin and Towne',
    slug: 'ziemann-larkin-and-towne',
    type: 'startup',
    registration_number: 'REG0404393048',
    tax_id: 'TAX931245572',
    email: 'haskell52@zulauf.com',
    phone: '+1.980.975.5993',
    address: '213 Emmalee Hill Apt. 336',
    city: 'West Max',
    country: 'Comoros',
    timezone: 'America/Rankin_Inlet',
    locale: 'fr',
    plan: 'free',
    subscription_status: 'canceled',
    trial_ends_at: '2026-06-07',
});

const submit = () => {
    console.log('Form submitted:', form);
    alert('Organization saved successfully!');
};
</script>
