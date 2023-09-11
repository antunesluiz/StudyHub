<script setup>
import { ref, watch, onMounted } from 'vue'

const props = defineProps({
    options: {
        type: Array,
        required: true
    },
});

const selectedOption = ref(props.id)

const emit = defineEmits(['update:value'])

watch(selectedOption, (newVal) => {
    emit('update:value', newVal)
})

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <select v-model="selectedOption"
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
        ref="input">
        <option v-for="option in options" :value="option">{{ option }}</option>
    </select>
</template>