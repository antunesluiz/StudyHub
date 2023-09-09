<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TopNavigation from './Partials/TopNavigation.vue';
import SearchInput from './Partials/SearchInput.vue'
import StudentTable from './Partials/StudentTable.vue'
</script>

<template>
    <AdminLayout title="Dashboard" class="sm:ml-64 bg-gray-100 dark:bg-gray-900 pt-4">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Estudantes
            </h2>
        </template>

        <div class="bg-gray-300 dark:bg-gray-700 py-8 px-6 sm:px-6 dark:text-gray-50 mt-4 rounded mx-4">
            <TopNavigation></TopNavigation>
            <div class="mt-4 flex flex-wrap flex-row">
                <SearchInput></SearchInput>
            </div>
            <StudentTable></StudentTable>
        </div>
    </AdminLayout>
</template>