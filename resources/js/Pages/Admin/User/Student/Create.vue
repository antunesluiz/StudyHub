<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TopNavigation from './Partials/TopNavigation.vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import UsernameSuggestions from '@/Components/UsernameSuggestions.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue'

import { VueTelInput } from 'vue3-tel-input'
import 'vue3-tel-input/dist/vue3-tel-input.css'
import { ref } from 'vue';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    username: '',
    password: '',
    password_confirmation: '',
    birthdate: '',
    gender: ''
});

const gender = [
    'Masculino',
    'Feminino',
    'Outros'
]

const onInput = (phone, phoneObject, input) => {
    if (phoneObject?.formatted) {
        form.phone = phoneObject.formatted
    }
}

const submitForm = () => {
    form.post(route('admin.student.store'), {
        errorBag: 'submitForm',
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
        },
    });
}

const useSuggestedUsername = (suggestion) => {
    form.username = suggestion;
    form.errors.username = null;
    form.errors.username_suggestions = [];
};

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

                <form @submit.prevent="submitForm" class="mt-6 space-y-6">
                    <div class="flex flex-wrap flex-row">
                        <div class="grow sm:mr-4">
                            <InputLabel for="name" value="Nome Completo" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                autofocus autocomplete="name" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="grow sm:mr-4">
                            <InputLabel for="username" value="Username" />

                            <TextInput id="username" type="text" class="mt-1 block w-full" v-model="form.username" required
                                autofocus autocomplete="username" />

                            <InputError class="mt-2" :message="form.errors.username" />
                            <UsernameSuggestions class="mt-2" :messages="form.errors.username_suggestions"
                                @suggestionClicked="useSuggestedUsername" />
                        </div>

                        <div class="grow sm:mr-4">
                            <InputLabel for="email" value="E-mail" />

                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                                autofocus autocomplete="email" />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                    </div>

                    <div class="flex flex-wrap flex-row">
                        <div class="grow sm:mr-4">
                            <InputLabel for="birthdate" value="Data aniversário" />

                            <TextInput id="birthdate" type="date" class="mt-1 block w-full" v-model="form.birthdate"
                                required autofocus autocomplete="birthdate" />

                            <InputError class="mt-2" :message="form.errors.birthdate" />
                        </div>

                        <div class="grow sm:mr-4">
                            <InputLabel for="gender" value="Gênero" />

                            <SelectInput v-model="form.gender" id="gender" class="mt-1 block w-full" required autofocus
                                autocomplete="gender" :options="gender" />

                            <InputError class="mt-2" :message="form.errors.gender" />
                        </div>

                        <div class="grow sm:mr-4">
                            <InputLabel for="phone" value="Telefone" />

                            <vue-tel-input id="phone" :value="form.phone" @input="onInput" mode="international" required
                                autofocus autocomplete="phone"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></vue-tel-input>


                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>
                    </div>

                    <div class="flex flex-wrap flex-row">
                        <div class="grow sm:mr-4">
                            <InputLabel for="password" value="Senha" />

                            <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                                required autofocus autocomplete="password" />

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="grow sm:mr-4">
                            <InputLabel for="password_confirmation" value="Confirme a senha" />

                            <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                                v-model="form.password_confirmation" required autofocus
                                autocomplete="password_confirmation" />

                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>
                    </div>

                    <div class="flex items-center gap-4 justify-end">
                        <PrimaryButton dusk="save-button" :disabled="form.processing">Salvar</PrimaryButton>

                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Salvo.</p>
                        </Transition>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>