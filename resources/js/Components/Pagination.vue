<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    meta: Object,
    search: String
});

</script>

<template>
    <div v-if="meta.links.length > 3">
        <div
            class="dark:bg-gray-800 bg-white px-4 py-3 flex items-center justify-between border-t border-b border-gray-200 dark:border-gray-600 sm:px-6">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <p v-if="meta.links.length > 3" class="text-sm text-gray-700 dark:text-gray-100">
                    Mostrando
                    {{ ' ' }}
                    <span class="font-medium">{{ meta.from }}</span>
                    {{ ' ' }}
                    a
                    {{ ' ' }}
                    <span class="font-medium">{{ meta.to }}</span>
                    {{ ' ' }}
                    de
                    {{ ' ' }}
                    <span class="font-medium">{{ meta.total }}</span>
                    {{ ' ' }}
                    resultados
                </p>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <div v-if="meta.links.length > 3">
                        <div class="flex flex-wrap -mb-1">
                            <template v-for="(link, key) in meta.links" :key="key">
                                <div v-if="link.url === null"
                                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded dark:border-gray-600"
                                    v-html="link.label" />
                                <Link v-else :data-testid="`pagination-link-${key}`"
                                    class="dark:border-gray-600 dark:text-gray-100 mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500 dark:hover:bg-gray-600"
                                    :class="{ 'bg-gray-900 text-white': link.active }" :href="link.url + '&filter=' + search"
                                    v-html="link.label" />
                            </template>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>
