<script setup lang="ts">
import { ref, watch } from "vue";
import type {
    Pagination,
    TableColumn,
} from "@/types/grid";
import type {
    Organization,
} from "@/types/organization";

interface Props {
    title: string;
    rows: Organization[];
    columns: TableColumn<Organization>[];
    pagination: Pagination;
    loading?: boolean;
}

const props = defineProps<Props>();

const emit = defineEmits<{
    (e: "search", value: string): void;
    (e: "page-change", page: number): void;
    (e: "clear-filters"): void;
    (
        e: "filter",
        value: Record<string, string>
    ): void;
}>();

const showFilters = ref(false);
const search = ref("");


const clearSearch = () => {
    search.value = "";
    emit("clear-filters");
};

const nextPage = (pagination: Pagination) => {
    if (
        pagination.current_page <
        pagination.last_page
    ) {
        emit(
            "page-change",
            pagination.current_page + 1
        );
    }
};

const prevPage = (pagination: Pagination) => {
    if (pagination.current_page > 1) {
        emit(
            "page-change",
            pagination.current_page - 1
        );
    }
};

let timeout: ReturnType<typeof setTimeout>;
watch(search, (value: string) => {
    clearTimeout(timeout);

    timeout = setTimeout(() => {

        /**
         * EMPTY SEARCH
         * reload all data
         */
        if (value.length === 0) {
            emit("search", "");

            return;
        }

        /**
         * WAIT UNTIL 3 CHARS
         */
        if (value.length < 3) {
            return;
        }

        emit("search", value);

    }, 500);
});
</script>

<template>
    <div class="p-4 space-y-4">
        <!-- HEADER -->
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">{{ props.title }}</h1>
            <div class="flex items-center gap-2">
                <!-- Search -->
                <div class="flex">
                    <input v-model="search" type="text" placeholder="Search..."
                        class="border rounded-l-full px-3 py-1 focus:outline-none" />
                    <button class="bg-blue-600 text-white px-4 rounded-r-full" @click="emit('search', search)">
                        Search
                    </button>
                </div>
                <button @click="clearSearch" class="border px-3 py-1 rounded">
                    Clear
                </button>
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
                    <!-- LOADING -->
                    <tr v-if="loading">
                        <td :colspan="columns.length + 2" class="text-center p-6">
                            Loading...
                        </td>
                    </tr>
                    <!-- EMPTY -->
                    <tr v-else-if="props.rows.length === 0">
                        <td :colspan="columns.length + 2" class="text-center p-6">
                            No data found
                        </td>
                    </tr>
                    <!-- DATA -->
                    <tr v-else v-for="row in props.rows" :key="row.id" class="border-t">
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
                @click="prevPage(pagination)">
                Prev
            </button>

            <span>
                Page {{ pagination.current_page }}
                of {{ pagination.last_page }}
            </span>

            <button class="px-3 py-1 border rounded disabled:opacity-50"
                :disabled="pagination.current_page === pagination.last_page" @click="nextPage(pagination)">
                Next
            </button>
        </div>

    </div>
</template>
