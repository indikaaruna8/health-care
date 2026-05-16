<script setup>
import { ref } from "vue";
defineProps({
    title: String,
    rows: Array,
    columns: Array,
    pagination: Object,
});
const showFilters = ref(false);
const search = ref("");
</script>

<template>
    <div class="p-4 space-y-4">
        <!-- HEADER -->
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">{{ title }}</h1>
            <div class="flex items-center gap-2">
                <!-- Search -->
                <div class="flex">
                    <input v-model="search" type="text" placeholder="Search..."
                        class="border rounded-l-full px-3 py-1 focus:outline-none" />
                    <button class="bg-blue-600 text-white px-4 rounded-r-full">
                        Search
                    </button>
                </div>
                <button @click="showFilters = !showFilters" class="border px-3 py-1 rounded">
                    Filters
                </button>
                <slot name="header-right" />
            </div>
        </div>
        <!-- FILTERS -->
        <div class="border p-3 rounded bg-gray-50" v-if="showFilters">
            <slot name="filters" />
        </div>

        <!-- TABLE -->
        <div class="border rounded overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2">
                            <input type="checkbox" />
                        </th>

                        <th v-for="col in columns" :key="col.key" class="p-2 text-left">
                            {{ col.label }}
                        </th>

                        <th class="p-2">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="row in rows" :key="row.id" class="border-t">
                        <td class="p-2">
                            <input type="checkbox" />
                        </td>

                        <td v-for="col in columns" :key="col.key" class="p-2">
                            {{ row[col.key] }}
                        </td>

                        <td class="p-2">
                            <slot name="row-actions" :row="row" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="flex justify-end items-center gap-2">
            <button class="px-3 py-1 border rounded">Prev</button>
            <span>
                Page {{ pagination.current }} / {{ pagination.total }}
            </span>
            <button class="px-3 py-1 border rounded">Next</button>
        </div>

    </div>
</template>
