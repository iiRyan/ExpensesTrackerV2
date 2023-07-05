<template>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign up for an account
            </h2>
        </div>



        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" @submit.prevent="register">

                <div>
                    <h2 class="block text-sm font-medium leading-6 bg-red-700 text-center text-white border-spacing-96">{{
                        state.errors }}</h2>
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" required v-model="state.name"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required="" v-model="state.email"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            v-model="state.password"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password_confirmation"
                            class="block text-sm font-medium leading-6 text-gray-900">password_confirmation</label>
                    </div>
                    <div class="mt-2">
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            autocomplete="current-password" required v-model="state.password_confirmation"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                        Up</button>
                </div>
                <p class="mt-10 text-center text-sm text-gray-500">
                    Have an Account?
                    <router-link :to="{ name: 'login' }" class="font-semibold leading-6 text-indigo-600
                    hover:text-indigo-500">Login</router-link>
                </p>
            </form>
        </div>
    </div>
</template>
  
<script setup>
import { reactive } from 'vue';
import axios from 'axios';
import router from '../router';
import Login from './Login.vue';



const state = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    errors: null,
});

const register = async () => {
    try {
        const response = await axios.post('http://127.0.0.1:8000/api/register', {
            name: state.name,
            email: state.email,
            password: state.password,
            password_confirmation: state.password_confirmation,
        });

        console.log('regstered', response.data)
        router.push({ name: 'login' })
    } catch (error) {
        state.errors = error.response.data.errors;

        console.error(error);
    }
    return { state, register };
};







</script>
  
<style lang="scss" scoped></style>