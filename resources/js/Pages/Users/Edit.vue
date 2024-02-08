<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateUserForm from './Partials/CreateUserForm.vue';
import UpdateUserForm from './Partials/UpdateUserForm.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    user: {
        type: Object,
    },
})

</script>

<template>
    <Head title="Editar usuário">
    </Head>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar usuário</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="row flex justify-end">
                    <Link :href="route('users')" class="mb-2">
                    <button type="button" class="inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium
                     rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none
                      focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                        </svg>
                        Voltar
                    </button></Link>
                </div>
                <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateUserForm :user="props.user"></UpdateUserForm>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
