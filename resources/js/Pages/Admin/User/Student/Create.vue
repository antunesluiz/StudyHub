<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TopNavigation from './Partials/TopNavigation.vue';
import StudentForm from './Partials/StudentForm.vue';

</script>

<template>
    <AdminLayout title="Add Estudantes" class="sm:ml-64 bg-gray-100 dark:bg-gray-900 pt-4 pb-4">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Adicionar Estudante
            </h2>
        </template>
        <div class="bg-gray-300 dark:bg-gray-700 py-8 px-6 sm:px-6 dark:text-gray-50 mt-4 rounded mx-4">
            <TopNavigation>
                <template #actualPage>> Adicionar Estudantes</template>
            </TopNavigation>

            <div class="mt-4">
                <header>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Preencha o formulário abaixo para adicionar um novo estudante.
                    </p>
                </header>

                <StudentForm></StudentForm>
            </div>
        </div>
    </AdminLayout>
</template>