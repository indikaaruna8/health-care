<script setup>
import { ref } from "vue";

defineProps({
    organizations: Array,
});

const showFilters = ref(false);
const search = ref("");
</script>

<template>
    <div class="p-4 space-y-4">

        <!-- Row 1: Top Actions -->
        <div class="flex items-center justify-between">

            <h1 class="text-xl font-semibold">Organizations</h1>

            <div class="flex items-center gap-2">
                <!-- Search -->
                <div class="flex">
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Search..."
                        class="border rounded-l-full px-3 py-1 focus:outline-none"
                    />
                    <button class="bg-blue-600 text-white px-4 rounded-r-full">
                        Search
                    </button>
                </div>

                <!-- Filter toggle -->
                <button
                    @click="showFilters = !showFilters"
                    class="border px-3 py-1 rounded"
                >
                    Filters
                </button>

                <!-- Add new -->
                <button class="bg-green-600 text-white px-3 py-1 rounded">
                    + Add New
                </button>
            </div>
        </div>

        <!-- Row 2: Filters -->
        <div v-if="showFilters" class="border p-3 rounded bg-gray-50">
            <div class="grid grid-cols-3 gap-3">
                <input class="border p-2 rounded" placeholder="Name filter" />
                <input class="border p-2 rounded" placeholder="Email filter" />
                <select class="border p-2 rounded">
                    <option>All Plans</option>
                    <option>Basic</option>
                    <option>Pro</option>
                </select>
            </div>
        </div>

        <!-- Row 3: Data Grid -->
        <div class="overflow-x-auto border rounded">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2">
                            <input type="checkbox" />
                        </th>
                        <th class="p-2 text-left">ID</th>
                        <th class="p-2 text-left">Name</th>
                        <th class="p-2 text-left">Phone</th>
                        <th class="p-2 text-left">Email</th>
                        <th class="p-2 text-left">Plan</th>
                        <th class="p-2 text-left">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="org in organizations"
                        :key="org.id"
                        class="border-t hover:bg-gray-50"
                    >
                        <td class="p-2">
                            <input type="checkbox" />
                        </td>
                        <td class="p-2">{{ org.id }}</td>
                        <td class="p-2">{{ org.name }}</td>
                        <td class="p-2">{{ org.phone }}</td>
                        <td class="p-2">{{ org.email }}</td>
                        <td class="p-2">{{ org.plan }}</td>

                        <td class="p-2 flex gap-2">
                            <button class="text-blue-600">Edit</button>
                            <button class="text-green-600">View</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>
