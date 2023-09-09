<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import StudentsCharts from './Partials/StudentsCharts.vue';
import ClassesCharts from './Partials/ClassesCharts.vue';

defineProps({
    studentChart: Object,
});

import VueApexCharts from "vue3-apexcharts";

const options = {
    chart: {
        id: 'vuechart-example',
        zoom: {
            enabled: false,
        },
        width: '100%'
    },
    plotOptions: {
        bar: {
            columnWidth: '30%',
        }
    },
    dataLabels: {
        enabled: true,
    },
    xaxis: {
        categories: [
            'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ],
        labels: {
            show: true,
        }
    },
    yaxis: {
        labels: {
            show: true,
        }
    },
    grid: {
        show: true,
    }
};

const series = [{
    name: 'Alunos',
    data: [895, 1107, 1230, 1300, 1759, 1300, 1230, 1300, 987, 100, 1000, 1992]
}];
</script>

<template>
    <AdminLayout title="Dashboard" class="sm:ml-64 bg-gray-100 dark:bg-gray-900 pt-4">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="flex flex-wrap flex-row mx-4">
            <StudentsCharts class="grow sm:mr-4" :studentChart="studentChart"></StudentsCharts>
            <ClassesCharts class="grow sm:mr-4"></ClassesCharts>
            <StudentsCharts class="grow" :studentChart="studentChart"></StudentsCharts>
        </div>

        <div class="flex flex-wrap flex-row mx-4">
            <div class="bg-gray-300 dark:bg-gray-700 py-8 px-6 sm:px-6 dark:text-gray-50 mt-4 rounded flex-grow py-4">
                <VueApexCharts width='100%' height="160%" type="line" :options="options" :series="series"></VueApexCharts>
            </div>
        </div>
    </AdminLayout>
</template>
