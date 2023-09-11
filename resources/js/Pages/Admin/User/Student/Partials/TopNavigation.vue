<script setup>

</script>

<template>
    <div class="flex flex-wrap items-center text-sm">
        <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
        </svg>
        <a :href="route('admin.index')" class="mr-2 text-blue-950 truncate">Home ></a>
        <p class="mr-2 truncate">Usuários ></p>
        <a class="mr-2 text-blue-950 truncate" :href="route('admin.student.index')">Estudantes</a>
        <div class="flex-shrink-0">
            <slot name="actualPage" />
        </div>
    </div>
</template>