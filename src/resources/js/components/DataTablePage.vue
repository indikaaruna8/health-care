<script setup lang="ts">
import { ref, watch } from "vue";
import type {
    Organization,
    Pagination,
    TableColumn,
} from "@/types/organization";

interface Props {
    title: string;
    rows: Organization[];
    columns: TableColumn[];
    pagination: Pagination;
    onSearch?: (query: string) => Promise<void>;
    onPageChange?: (page: number) => Promise<void>;
}

const props = defineProps<Props>();

const showFilters = ref<boolean>(false);
const search = ref<string>("");
const loading = ref<boolean>(false);

let timeout: ReturnType<typeof setTimeout>;

watch(search, (value: string) => {
    clearTimeout(timeout);

    if (!value || value.length < 3) {
        return;
    }

    timeout = setTimeout(async () => {
        if (!props.onSearch) return;

        loading.value = true;

        try {
            await props.onSearch(value);
        } finally {
            loading.value = false;
        }
    }, 500);
});

/**
 * PAGINATION
 */
const nextPage = async () => {
    if (
        props.pagination.current_page <
        props.pagination.last_page
    ) {
        await props.onPageChange?.(
            props.pagination.current_page + 1
        );
    }
};

const prevPage = async () => {
    if (props.pagination.current_page > 1) {
        await props.onPageChange?.(
            props.pagination.current_page - 1
        );
    }
};
</script>

<template>
    <div class="p-4 space-y-4">
        <!-- HEADER -->
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">{{ title }}ss</h1>
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
                    <tr v-if="loading">
                        <td :colspan="columns.length + 2" class="text-center p-4">
                            Loading...
                        </td>
                    </tr>
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
            <button class="px-3 py-1 border rounded disabled:opacity-50" :disabled="pagination.current_page === 1"
                @click="prevPage">
                Prev
            </button>

            <span>
                Page {{ pagination.current_page }}
                of {{ pagination.last_page }}
            </span>

            <button class="px-3 py-1 border rounded disabled:opacity-50"
                :disabled="pagination.current_page === pagination.last_page" @click="nextPage">
                Next
            </button>
        </div>

    </div>
</template>
