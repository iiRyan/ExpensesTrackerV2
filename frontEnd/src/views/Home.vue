<template>
    <div>
        <Navbar />
    </div>
    <div class="items-center justify-center">
        <button type="button" @click="openModal"
            class="rounded-md m-7 bg-gray-800  px-4 py-2 text-sm font-medium text-white hover:bg-opacity-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
            Add new Budget
        </button>
    </div>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white text-lg p-6 text-left align-middle shadow-xl transition-all">
                            <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                                Add new Budget
                            </DialogTitle>
                            <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8 p-10" action="POST"
                                @submit.prevent="createMonth">
                                <div>
                                    <label for="month"
                                        class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-900">Month</label>
                                    <input type="text" id="month"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-500 dark:placeholder-gray-400 dark:text-black"
                                        required="" v-model="state.month">
                                </div>
                                <div>
                                    <label for="amount"
                                        class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-900">Amount</label>
                                    <input type="number"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-500 dark:placeholder-gray-400 dark:text-black"
                                        required="" v-model="state.income">
                                </div>
                                <div class="flex justify-between">
                                    <div class="flex items-start">
                                    </div>
                                </div>
                                <button type="submit" @click="closeModal"
                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg
                                     text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                            </form>
                            <div class="mt-4">
                                <button type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                    @click="closeModal">
                                    Cancel
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>

    <div class="justify-center text-center p-5">
        <ul class="" v-for="month in months" :key="month.id">
            <li class="p-4 mb-3 flex justify-between items-center text-center bg-white shadow rounded-lg">
                <router-link :to="{ name: 'expensesList', params: { monthId: month.id } }">
                    <p class="ml-2 text-gray-700 font-semibold font-sans">{{ month.attributes.month }}</p>
                </router-link>
                <div class="flex justify-center text-center cursor-pointer">
                    <button aria-label="Edit user" class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>
                    <button @click.prevent="deleteMonth(month.id)" aria-label="Delete user" class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-red-400 hover:bg-opacity-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </li>
        </ul>
    </div>
</template>
  
<script setup>
import { ref, reactive } from "vue";
import { store } from "../store";
import axios from "axios";
import Navbar from "../components/Navbar.vue";
import { useRoute, useRouter } from 'vue-router';


import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
const route = useRoute();

const isOpen = ref(false)

function closeModal() {
    isOpen.value = false
}
function openModal() {
    isOpen.value = true
}

const months = ref([]);

const state = reactive({
    month: '',
    income: '',
    errors: null,
});


const loadMonths = async () => {
    try {
        const response = await axios.get(`http://127.0.0.1:8000/api/months`, {
            headers: { Authorization: `Bearer ${store.token}` },

        });
        if (response.status === 200) {
            months.value = response.data.data
        }
    } catch (err) {
        console.error(err)
    }
}
loadMonths()

const createMonth = async () => {
    try {
        const response = await axios.post('http://127.0.0.1:8000/api/months', {
            month: state.month,
            income: state.income,
        }, {
            headers: { Authorization: `Bearer ${store.token}` },

        }
        );
        await loadMonths();
    } catch (error) {
        state.errors = error.response.data.errors;

        console.error(error);
    }
    return { state, createMonth };
};
const monthId = route.params.monthId;

const deleteMonth = async (monthId) => {
    var result = confirm("Are you sure you want to delete?");
    if (result) {
        try {
            const response = await axios.delete(`http://127.0.0.1:8000/api/months/${monthId}`, {
                headers: { Authorization: `Bearer ${store.token}` },
            });

            await loadMonths();
        } catch (error) {

            console.error(error);
        }
        return { deleteMonth };
    };
}






</script>