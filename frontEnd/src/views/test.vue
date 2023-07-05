<template>
    <div>
    <div class="flex items-center justify-center mb-3 my-10 mx-auto gap-10">
        <h1 class="text-3xl font-semibold">Expenses List</h1>
        <div class="items-center justify-center">
            <button type="button" @click="openModal"
                class="rounded-md bg-gray-800  px-4 py-2 text-sm font-medium text-white hover:bg-opacity-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
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
                                <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8 p-10" action="POST" @submit.prevent="createExpense">
                                    <div>
                                        <label for="month"
                                            class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-900">Description</label>
                                        <input type="text" id="month"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-500 dark:placeholder-gray-400 dark:text-black"
                                            required="" v-model="state.description">
                                    </div>
                                    <div>
                                        <label for="amount"
                                            class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-900">Amount</label>
                                        <input type="number"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-500 dark:placeholder-gray-400 dark:text-black"
                                            required="" v-model="state.amount">
                                    </div>
                                    <div>
                                        <label for="month"
                                            class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-900">Bank
                                            Account</label>
                                        <input type="text" id="month"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-500 dark:placeholder-gray-400 dark:text-black"
                                            required="" v-model="state.bank_account" >
                                    </div>
                                    <button type="submit"
                                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg
                                     text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                                </form>
                                <div class="mt-4">
                                    <button type="button"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900
                                         hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
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
    </div>
    <div class="p-5 m-10 flex items-center justify-center">
        <table class="divide-y divide-green-400 text-center justify-center flex-auto bg-black">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-2 text-xs text-gray-500">
                        ID
                    </th>
                    <th class="px-6 py-2 text-xs text-gray-500">
                        Description
                    </th>
                    <th class="px-6 py-2 text-xs text-gray-500">
                        Amount
                    </th>
                    <th class="px-6 py-2 text-xs text-gray-500">
                        Bank Account
                    </th>
                    <th class="px-6 py-2 text-xs text-gray-500">
                        Edit
                    </th>
                    <th class="px-6 py-2 text-xs text-gray-500">
                        Delete
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-300" v-for="(month, index) in months" :key="index">
                <tr class="whitespace-nowrap">
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ index + 1 }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">
                            {{ month.attributes.description }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500"> {{ month.attributes.amount }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ month.attributes.bank_account }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 
                      2 0 112.828 
                      2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 
                      4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>
<script setup>
import axios from 'axios';
import { reactive, ref , } from 'vue';
import { store } from '../store';
import { onMounted } from 'vue';

const months = ref([]);
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'

const isOpen = ref(false)

function closeModal() {
    isOpen.value = false
}
function openModal() {
    isOpen.value = true
}

const loadData = async () => {
    try {
        const response = await axios.get('http://127.0.0.1:8000/api/expenses', {
            headers: {
                Authorization: `Bearer ${store.token}`,
            },
        });

        months.value = response.data.data
        console.log(months.value)
    } catch (err) {
        console.log(err);
    }
    return { months }
};

onMounted(() => {
    loadData();
});


const state = reactive({
    description: '',
    month_id: '',
    amount: '',
    bank_account: '',
});
const createExpense = async () => {
    try {
        await axios.post('http://127.0.0.1:8000/api/expenses', {
            description: state.description,
            month_id: 1,
            amount: state.amount,
            bank_account: state.bank_account,
        }, {
            headers: { Authorization: `Bearer ${store.token}` },

        }
        );
        // Reload the data after successfully posting the new expense
        await loadData();
        // Close the modal after successfully posting the new expense
        closeModal();
    } catch (error) {
        console.error(error);
    }
};

</script>

<style lang="scss" scoped></style>