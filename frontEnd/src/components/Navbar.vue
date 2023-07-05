<template>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <router-link :to="{ name: 'home' }" class="flex items-center">
                            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Expense
                                Tracker</span>
                        </router-link>
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <button @click="logout"
                        class="ml-auto text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Logout</button>
                </div>
            </div>
        </div>

    </nav>
</template>


<script>
import { reactive } from 'vue';
import { store } from '../store';
import axios from 'axios';
import router from '../router'
import Navbar from '../components/Navbar.vue';

// const state = reactive({
//     token: store.token
// });



export default {

    setup() {
        const logout = async () => {
            try {
                const token = localStorage.getItem('token')
                console.log(store.token)
                await axios.post('http://127.0.0.1:8000/api/logout', {},
                    {
                        headers: {
                            Authorization: `Bearer ${token}` // include the token in the Authorization header
                        },


                    })
                localStorage.removeItem('token')
                // Redirect to the login page after logout
                router.push({ name: 'login' })

            } catch (error) {
                console.log(error);
            }
        };



        return {
            logout
        };
    }
};
</script>