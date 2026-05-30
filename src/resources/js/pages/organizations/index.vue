<script setup lang="ts">
import { ref, onMounted, reactive, watch } from "vue";
import DataTablePage from "@/components/DataTablePage.vue";
import organizationsApi from '@/routes/organizations';
import { organizationService } from "@/services/organization";
import type { Pagination, TableColumn } from "@/types/grid";
import type { Organization } from "@/types/organization";



const organizations = ref<Organization[]>([]);
const search = ref<string>("");
const loading = ref(false);
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

const filters = reactive({
    name: "",
    email: "",
    plan: "",
});

const goToCreate = () => {
    window.location.href = organizationsApi.create().url;
};

const columns: TableColumn<Organization>[] = [
    { key: "id", label: "ID" },
    { key: "name", label: "Name" },
    { key: "phone", label: "Phone" },
    { key: "email", label: "Email" },
    { key: "plan", label: "Plan" },
];

const clearFilters = () => {
    filters.name = "";
    filters.email = "";
    filters.plan = "";
};

const loadOrganizations = async (
    search = "",
    page = 1
) => {
    loading.value = true;

    try {
        const response = await organizationService.search(
            search,
            page,
            filters
        );
        organizations.value =
            response.data;
        pagination.value =
            response.meta.pagination;

    } finally {
        loading.value = false;
    }
};

const searchOrganizations = async (
    query: string
) => {
    await loadOrganizations(query, 1);
};

const changePage = async (
    page: number
) => {
    await loadOrganizations(
        search.value,
        page
    );
};

let timeout: ReturnType<typeof setTimeout>;
watch(
    filters,
    () => {
        clearTimeout(timeout);
        timeout = setTimeout(async () => {
            await loadOrganizations();
        }, 1000);
    },
    {
        deep: true,
    }
);


onMounted(async () => {
    await loadOrganizations();
});
</script>

<template>
    <DataTablePage title="Organizations" :rows="organizations" :columns="columns" :pagination="pagination"
        :loading="loading" @search="searchOrganizations" @page-change="changePage" @clear-filters="clearFilters">

        <!-- HEADER RIGHT -->
        <template #header-right>
            <!-- Add new -->
            <button class="bg-green-600 text-white px-3 py-1 rounded" @click="goToCreate">
                + Add
            </button>
        </template>

        <!-- FILTERS -->
        <template #filters>
            <div class="grid grid-cols-3 gap-2">

                <input v-model="filters.name" class="border p-2 rounded" placeholder="Name" />

                <input v-model="filters.email" class="border p-2 rounded" placeholder="Email" />

                <select v-model="filters.plan" class="border p-2 rounded">
                    <option value="">
                        All Plans
                    </option>

                    <option value="free">
                        Free
                    </option>

                    <option value="basic">
                        Basic
                    </option>

                    <option value="premium">
                        Premium
                    </option>
                </select>

            </div>
        </template>
        <!-- ROW ACTIONS -->
        <template #row-actions="{ row }">
            <button class="text-blue-600">Edit {{ row.name }}</button>
            <button class="text-green-600 ml-2">View</button>
        </template>
    </DataTablePage>
</template>
