<script setup lang="ts">
import axios from "axios";
import { ref, onMounted } from "vue";


import DataTablePage from "@/components/DataTablePage.vue";

import type {
    Organization,
    Pagination,
    ApiResponse,
    TableColumn,
} from "@/types/organization";

const organizations = ref<Organization[]>([]);
const search = ref<string>("");
const pagination = ref<Pagination>({
    current_page: 1,
    per_page: 15,
    total: 0,
    last_page: 1,
    from: 0,
    to: 0,
    has_more_pages: false,
    next_page_url: null,
    previous_page_url: null,
});

const columns: TableColumn[] = [
    { key: "id", label: "ID" },
    { key: "name", label: "Name" },
    { key: "phone", label: "Phone" },
    { key: "email", label: "Email" },
    { key: "plan", label: "Plan" },
];

const loadOrganizations = async (
    search = "",
    page = 1
) => {
    const response = await axios.get<ApiResponse<Organization>>(
        "/organization/search",
        {
            params: {
                search,
                page,
            },
        }
    );

    organizations.value = response.data.data;
    pagination.value = response.data.meta.pagination;
};

const searchOrganizations = async (
    query: string
) => {
    search.value = query;
    await loadOrganizations(query, 1);
};

const changePage = async (page: number) => {
    await loadOrganizations(search.value, page);
};

onMounted(async () => {
    await loadOrganizations();
});
</script>

<template>
    <DataTablePage title="Organizations" :rows="organizations" :columns="columns" :pagination="pagination"
        :onSearch="searchOrganizations" :onPageChange="changePage">

        <!-- HEADER RIGHT -->
        <template #header-right>
            <!-- Add new -->
            <button class="bg-green-600 text-white px-3 py-1 rounded">
                + Add
            </button>
        </template>

        <!-- FILTERS -->
        <template #filters>
            <div class="grid grid-cols-3 gap-2">
                <input class="border p-2 rounded" placeholder="Name" />
                <input class="border p-2 rounded" placeholder="Email" />
                <select class="border p-2 rounded">
                    <option>All Plans</option>
                </select>
            </div>
        </template>

        <!-- ROW ACTIONS -->
        <template #row-actions="{ row }">
            <button class="text-blue-600">Edit</button>
            <button class="text-green-600 ml-2">View</button>
        </template>
    </DataTablePage>
</template>
