<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { TailwindPagination } from 'laravel-vue-pagination';
import axios from 'axios';

const confirmingUserDeletion = ref(false);

var props = defineProps({
    columns: {
        type: Array,
        default: [],
    },
    items: {
        type: Object,
        default: [],
    },
    edit: {
        type: String,
        default: "",
    },
    destroy: {
        type: Function,
        default: "",
    },
    userAuthid: {
        type: Number,
    },
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
}

const deleteUser = (id) => {
    props.destroy(id);
    closeModal();
}

const getItems = (page = 1) => {

    axios.get(`/api/users/${props.userAuthid}?page=${page}`)
        .then(response => {
            props.items = response.data;
            console.log(props.items, response.data);


        }).catch(error => {
            console.log(error);
        });
}
</script>

<template>
    <div class="overflow-x-auto">
        <table class="divide-y divide-gray-300 w-full">
            <thead class="bg-gray-50">
                <tr>
                    <template v-for="column in props.columns">
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            {{ column.label }}
                        </th>
                    </template>
                    <template v-if="edit">
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Editar</span>
                        </th>
                    </template>
                    <template v-if="destroy">
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Excluir</span>
                        </th>
                    </template>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <template v-for="item in props.items.data">

                    <tr>
                        <template v-for="column in props.columns">
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ item[column.column] }}
                            </td>
                        </template>
                        <template v-if="edit !== ''">
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                <Link :href="route(edit, item.id)" class="text-indigo-600 hover:text-indigo-900">Editar
                                </Link>
                            </td>
                        </template>
                        <template v-if="destroy">
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                <button @click="confirmUserDeletion"
                                    class="text-indigo-600 hover:text-indigo-900">Excluir</button>
                            </td>
                        </template>
                    </tr>

                    <Modal v-if="destroy" :show="confirmingUserDeletion" @close="closeModal">
                        <div class="p-6">
                            <h2 class="text-lg font-medium text-gray-900">
                                Você tem certeza de que deseja este usuário?
                            </h2>

                            <div class="mt-6 flex justify-end">
                                <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

                                <DangerButton class="ms-3" @click="deleteUser(item.id)">
                                    Excluir
                                </DangerButton>
                            </div>
                        </div>
                    </Modal>
                </template>
            </tbody>
        </table>
        <div class="row flex justify-center">
            <div class="my-4">
                <!-- <TailwindPagination :data="props.items" @pagination-change-page="getItems" /> -->
            </div>
        </div>
    </div>
</template>
