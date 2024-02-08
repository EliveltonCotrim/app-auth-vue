<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';

defineProps({

    status: {
        type: String,
    },
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});
</script>

<template>
    <section>

        <form @submit.prevent="form.post(route('users.store'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Nome" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"  autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="password" value="Senha" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"  />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Corfirmar senha" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation"  autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>

                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Salvo.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
