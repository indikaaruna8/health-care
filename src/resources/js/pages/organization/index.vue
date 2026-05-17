<script setup>
import DataTablePage from "@/components/DataTablePage.vue";
import { ref, onMounted } from "vue";
import axios from "axios";

defineProps({
    orgs: Array,
});

const organizations = ref([]);

/**
 * API CALL
 */
const searchOrganizations = async (query = "") => {
    const res = await axios.get("/organization/search", {
        params: { search: query },
    });

    organizations.value = res.data.data;
};

/**
 * LOAD ON PAGE START
 */
onMounted(() => {
    searchOrganizations(); // 👈 initial load
});
</script>

<template>
    <DataTablePage title="Organizations" :rows="organizations" :columns="[
        { key: 'id', label: 'ID' },
        { key: 'name', label: 'Name' },
        { key: 'phone', label: 'Phone' },
        { key: 'email', label: 'Email' },
        { key: 'plan', label: 'Plan' },
    ]" :pagination="{ current: 1, total: 10 }">

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
