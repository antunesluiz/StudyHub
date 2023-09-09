<script setup>

import VueApexCharts from "vue3-apexcharts";

const options = {
    chart: {
        id: 'vuechart-example',
        zoom: {
            enabled: false,
        },

    },
    plotOptions: {
        bar: {
            dataLabels: {
                total: {
                    enabled: false,

                }
            },
        }
    },
    xaxis: {
        categories: [
            'Agosto', 'Setembro', 'Outubro'
        ],
        labels: {
          show: false,
        }
    },
    yaxis: {
        labels: {
          show: false,
        }
    },
    grid: {
        show: false,
    }
};

const series = [{
    name: 'Alunos',
    data: [895, 1107, 1230]
}];
</script>


<template>
    <div class="bg-gray-300 dark:bg-gray-700 py-8 px-6 sm:px-6 dark:text-gray-50 mt-4 rounded flex">
        <div>
            <p class="text-sm text-gray-600 dark:text-gray-400">Alunos</p>
            <p class="text-4xl text-black dark:text-gray-100">1230</p>
            <p class="text-sm text-gray-600 dark:text-gray-400">+10% Desde mês passado</p>
        </div>

        <VueApexCharts width="200" type="bar" :options="options" :series="series"></VueApexCharts>
    </div>
</template>