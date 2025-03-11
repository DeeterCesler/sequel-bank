<script setup lang="ts">
import { onMounted, ref } from 'vue';
import axios from 'axios';

const props = defineProps<{
    accountId: string;
    show: boolean;
}>();

const emit = defineEmits(['update:show']);

const account = ref(null);
const transactions = ref([]);
const loading = ref(true);
const error = ref(null);

onMounted(async () => {
    try {
        const response = await axios.get(`/accounts/${props.accountId}`);
        console.log(response.data);
        account.value = response.data.account;
        transactions.value = response.data.transactions;
    } catch (e) {
        error.value = "Unable to load account details";
    } finally {
        loading.value = false;
    }
});

const closeModal = () => {
    emit('update:show', false);
};
</script>

<template>
    <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="closeModal"></div>

        <!-- Modal -->
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all dark:bg-gray-800 sm:my-8 sm:w-full sm:max-w-2xl sm:p-6">
                <!-- Header -->
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Account Details</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        <!-- Viewing account {{ account.value.number }} -->
                    </p>
                </div>

                <!-- Content -->
                <div v-if="loading" class="py-4 text-gray-600 dark:text-gray-300">Loading...</div>
                <div v-else-if="error" class="py-4 text-red-600">{{ error }}</div>
                <div v-else>
                    <!-- Account Summary -->
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="font-medium text-gray-900 dark:text-white">Account Type</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ account.type }}</p>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900 dark:text-white">Balance</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">${{ account.balance }}</p>
                        </div>
                    </div>

                    <!-- Transactions Table -->
                    <div class="mt-4 overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Description</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Amount</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                                <tr v-for="transaction in transactions" :key="transaction.id">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ new Date(transaction.created_at).toLocaleDateString() }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ transaction.description }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm" :class="transaction.type === 'deposit' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'">
                                        {{ transaction.type === 'deposit' ? '+' : '-' }}${{ transaction.amount }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ transaction.status }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Close button -->
                <div class="mt-5 sm:mt-6">
                    <button
                        type="button"
                        class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:text-sm"
                        @click="closeModal"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template> 