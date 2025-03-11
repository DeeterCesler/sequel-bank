<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import AccountLookupModal from '@/components/AccountLookupModal.vue';
import { ref, onMounted } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

interface Props {
    lookupAccount?: string;
}

const props = defineProps<Props>();
const showModal = ref(false);
const accountId = ref<string | null>(null);

onMounted(() => {
    const params = new URLSearchParams(window.location.search);
    accountId.value = params.get('account');
    if (accountId.value) {
        showModal.value = true;
    }
});

const handleShowModal = (id: string) => {
    accountId.value = id;
    showModal.value = true;
    // Use Inertia's router to update URL
    router.get(
        '/dashboard', 
        { account: id }, 
        { 
            preserveState: true,
            preserveScroll: true,
            replace: true 
        }
    );
};

const handleCloseModal = () => {
    showModal.value = false;
    accountId.value = null;
    // Use Inertia's router to remove parameter
    router.get(
        '/dashboard', 
        {}, 
        { 
            preserveState: true,
            preserveScroll: true,
            replace: true 
        }
    );
};
</script>

<template>
    <Head title="SequelBank - Dashboard">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    </Head>

    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white dark:from-gray-900 dark:to-gray-800">
        <!-- Navigation -->
        <header class="border-b border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <div class="flex items-center">
                    <div class="flex h-10 w-10 items-center justify-center rounded-md bg-blue-600 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>
                    </div>
                    <span class="ml-3 text-xl font-bold text-gray-900 dark:text-white">SequelBank</span>
                </div>

                <nav class="hidden space-x-8 md:flex">
                    <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Accounts</a>
                    <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Transfers</a>
                    <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Payments</a>
                    <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Settings</a>
                </nav>

                <div class="flex items-center space-x-4">
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:hover:bg-blue-500"
                    >
                        Sign Out
                    </Link>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <h1 class="mb-8 text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                Welcome, {{ $page.props.auth.user.name }}
            </h1>

            <div class="grid gap-6 md:grid-cols-3">
                <!-- Account Summary Card -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <h2 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Account Summary</h2>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Email:</span> {{ $page.props.auth.user.email }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Account:</span> 
                            <a 
                                href="#" 
                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300" 
                                @click.prevent="handleShowModal($page.props.auth.user.account_id)"
                            >
                                View Account
                            </a>
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Member Since:</span> 
                            {{ new Date($page.props.auth.user.created_at).toLocaleDateString() }}
                        </p>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <h2 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Quick Actions</h2>
                    <div class="space-y-3">
                        <button class="w-full rounded-md bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700 hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-300">
                            Make a Transfer
                        </button>
                        <button class="w-full rounded-md bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700 hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-300">
                            Pay a Bill
                        </button>
                        <button class="w-full rounded-md bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700 hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-300">
                            View Statements
                        </button>
                    </div>
                </div>

                <!-- Security Status Card -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <h2 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Security Status</h2>
                    <div class="space-y-2">
                        <p class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                            <svg class="mr-2 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            2FA Enabled
                        </p>
                        <p class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                            <svg class="mr-2 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Email Verified
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <AccountLookupModal
        v-if="accountId"
        v-model:show="showModal"
        :account-id="accountId"
        @update:show="handleCloseModal"
    />
</template>
