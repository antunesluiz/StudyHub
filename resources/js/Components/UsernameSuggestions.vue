<script setup>
import { ref } from 'vue';
import { defineProps, defineEmits } from 'vue';

const { messages } = defineProps({
    messages: Array,
});

const emit = defineEmits();

const isVisible = ref(true);

const suggestUsername = (suggestion) => {
    emit('suggestionClicked', suggestion);
    isVisible.value = false;
};
</script>

<template>
    <div v-show="messages && isVisible">
        <p v-for="(message, index) in messages" :key="index" class="text-sm text-red-600 dark:text-red-400"
            @click="suggestUsername(message)">
            {{ message }}
        </p>
    </div>
</template>
