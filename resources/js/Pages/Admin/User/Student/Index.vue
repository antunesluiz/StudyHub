<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TopNavigation from './Partials/TopNavigation.vue';
import SearchInput from './Partials/SearchInput.vue'
import StudentTable from './Partials/StudentTable.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    students: Object,
    filter: String
});

</script>

<template>
    <AdminLayout title="Estudantes" class="sm:ml-64 bg-gray-100 dark:bg-gray-900 pt-4 pb-4">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Estudantes
            </h2>
        </template>

        <div class="bg-gray-300 dark:bg-gray-700 py-8 px-6 sm:px-6 dark:text-gray-50 mt-4 rounded mx-4">
            <TopNavigation></TopNavigation>
            <div class="mt-4 flex flex-wrap flex-row justify-between">
                <SearchInput :filter="filter" class="md:w-1/3 w-full"></SearchInput>
                <Link :href="route('admin.student.create')">
                <PrimaryButton class="mt-4 text-right">Adicionar estudante</PrimaryButton>
                </Link>
            </div>
            <StudentTable :students="students" :search="filter"></StudentTable>
        </div>
    </AdminLayout>
</template>