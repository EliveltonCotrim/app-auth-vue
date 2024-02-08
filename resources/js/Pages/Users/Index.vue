<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Table from '@/Components/Table.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({
    users: { Object },
    userAuthid: { Number },
})

const deleteUser = (id) => {
    router.delete(route('users.destroy', id));
}
</script>

<template>
    <Head title="Usuários" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Usuários</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="row flex justify-end">
                    <Link :href="route('users.create')" class="mb-2">
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium
                     rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none
                      focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Cadastrar
                    </button></Link>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <Table :columns="[
                        { 'label': 'Nome', 'column': 'name' },
                        { 'label': 'Email', 'column': 'email' },
                    ]" :items="users" :userAuthid="userAuthid" edit="users.edit" :destroy="deleteUser"></Table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
