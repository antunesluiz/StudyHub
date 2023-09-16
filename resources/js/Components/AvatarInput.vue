<script setup>
import { ref } from 'vue';

const emit = defineEmits(['update:modelValue']);

let input = ref(null);
let src = ref('https://e7.pngegg.com/pngimages/348/800/png-clipart-man-wearing-blue-shirt-illustration-computer-icons-avatar-user-login-avatar-blue-child.png')

const browse = () => {
    input.value.click();
}

const change = (e) => {
    const file = e.target.files[0]

    emit('update:modelValue', file);

    let reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = (e) => {
        src.value = e.target.result;
    }
}

</script>

<template>
    <div>
        <input type="file" accept="image/*" class="hidden" ref="input" @change="change">
        <div class="relative inline-block">
            <img :src="src" alt="profile_photo" class="h-24 w-24 rounded-full object-cover">

            <div class="absolute top-0 h-full w-full bg-opacity-25 rounded-full flex items-center justify-center">
                <button type="button" @click="browse"
                    class="rounded-full hover:bg-white hover:bg-opacity-25 p-2 focus:outline-none text-white transition duration-200">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 12.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 3h-2l-.447-.894A2 2 0 0 0 12.764 1H7.236a2 2 0 0 0-1.789 1.106L5 3H3a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V5a2 2 0 0 0-2-2Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>