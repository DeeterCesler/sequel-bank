<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps<{
  status?: string;
  canResetPassword?: boolean;
}>();

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const isSubmitting = ref(false);

const submit = () => {
  isSubmitting.value = true;
  form.post(route('login'), {
    onFinish: () => {
      isSubmitting.value = false;
      form.reset('password');
    },
    onError: () => {
      isSubmitting.value = false;
    },
    preserveScroll: true,
  });
};
</script>

<template>
  <Head title="SequelBank - Home">
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
          <span class="ml-3 text-sm font-bold text-gray-900 dark:text-white">The Next Best Thing in Banking</span>
        </div>

        <nav class="hidden space-x-8 md:flex">
          <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Personal</a>
          <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Business</a>
          <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Wealth</a>
          <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">About Us</a>
        </nav>

        <div class="flex items-center space-x-4">
          <Link
            v-if="$page.props.auth.user"
            :href="route('dashboard')"
            class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:hover:bg-blue-500"
          >
            Dashboard
          </Link>
          <Link
            v-else
            :href="route('register')"
            class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:hover:bg-blue-500"
          >
            Open an Account
          </Link>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
      <div class="flex flex-col gap-8 lg:flex-row">
        <!-- Left side - Welcome content -->
        <div class="flex-1 lg:pr-8">
          <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Banking made simple</h1>
          <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
            Experience secure, convenient, and personalized banking services designed to meet your financial needs.
          </p>

          <div class="mt-8 grid gap-6 sm:grid-cols-2">
            <!-- Feature 1 -->
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
              <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-blue-600 dark:text-blue-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                </svg>
              </div>
              <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Fast Transfers</h3>
              <p class="text-gray-600 dark:text-gray-300">Send money instantly to anyone, anywhere with our secure transfer system.</p>
            </div>

            <!-- Feature 2 -->
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
              <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-blue-600 dark:text-blue-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
              </div>
              <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Enhanced Security</h3>
              <p class="text-gray-600 dark:text-gray-300">Your financial data is protected with industry-leading security protocols.</p>
            </div>

            <!-- Feature 3 -->
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
              <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-blue-600 dark:text-blue-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                </svg>
              </div>
              <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Financial Insights</h3>
              <p class="text-gray-600 dark:text-gray-300">Get personalized insights to help you manage your money more effectively.</p>
            </div>

            <!-- Feature 4 -->
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
              <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-blue-600 dark:text-blue-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Smart Savings</h3>
              <p class="text-gray-600 dark:text-gray-300">Automated tools to help you save more and reach your financial goals faster.</p>
            </div>
          </div>

          <div class="mt-8">
            <a href="#" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Learn more about our services →</a>
          </div>
        </div>

        <!-- Right side - Login form -->
        <div class="mt-8 w-full lg:mt-0 lg:w-80">
          <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800">
            <div class="border-b border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700">
              <h2 class="text-lg font-medium text-gray-900 dark:text-white">Returning Customers</h2>
            </div>
            <div class="px-6 py-6">
              <form @submit.prevent="submit">
                <div class="space-y-4">
                  <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input
                      id="email"
                      v-model="form.email"
                      type="email"
                      required
                      autocomplete="email"
                      class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                    />
                    <div v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</div>
                  </div>

                  <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <input
                      id="password"
                      v-model="form.password"
                      type="password"
                      required
                      autocomplete="current-password"
                      class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                    />
                    <div v-if="form.errors.password" class="mt-1 text-sm text-red-600">{{ form.errors.password }}</div>
                  </div>

                  <div class="flex items-center justify-between">
                    <div class="flex items-center">
                      <input
                        id="remember"
                        v-model="form.remember"
                        type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                      />
                      <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Remember me</label>
                    </div>
                    <div class="text-sm">
                      <Link :href="route('password.request')" class="text-blue-600 hover:text-blue-500 dark:text-blue-400">Forgot password?</Link>
                    </div>
                  </div>

                  <div>
                    <button
                      type="submit"
                      :disabled="form.processing"
                      class="flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-75 dark:hover:bg-blue-500"
                    >
                      <svg v-if="isSubmitting" class="mr-2 h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                      </svg>
                      Sign In
                    </button>
                  </div>
                </div>
              </form>
              <div class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
                Don't have an account?
                <Link :href="route('register')" class="font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400">
                  Register now
                </Link>
              </div>
            </div>
          </div>

          <div class="mt-6 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="text-sm font-medium text-gray-900 dark:text-white">Download Our Mobile App</h3>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Bank on the go with our secure mobile application.</p>
            <div class="mt-3 flex space-x-2">
              <button class="flex items-center rounded-md bg-gray-100 px-3 py-1 text-xs font-medium text-gray-800 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
                iOS
              </button>
              <button class="flex items-center rounded-md bg-gray-100 px-3 py-1 text-xs font-medium text-gray-800 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                </svg>
                Android
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="mt-12 border-t border-gray-200 bg-gray-50 py-8 dark:border-gray-700 dark:bg-gray-800">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
          <div>
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Products</h3>
            <ul class="mt-4 space-y-2">
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Checking</a></li>
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Savings</a></li>
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Credit Cards</a></li>
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Loans</a></li>
            </ul>
          </div>
          <div>
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Support</h3>
            <ul class="mt-4 space-y-2">
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Help Center</a></li>
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Contact Us</a></li>
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Security</a></li>
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Community</a></li>
            </ul>
          </div>
          <div>
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Company</h3>
            <ul class="mt-4 space-y-2">
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">About</a></li>
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Careers</a></li>
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Press</a></li>
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Blog</a></li>
            </ul>
          </div>
          <div>
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Legal</h3>
            <ul class="mt-4 space-y-2">
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Privacy</a></li>
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Terms</a></li>
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Cookie Policy</a></li>
              <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Licenses</a></li>
            </ul>
          </div>
        </div>
        <div class="mt-8 border-t border-gray-200 pt-8 dark:border-gray-700">
          <p class="text-center text-sm text-gray-500 dark:text-gray-400">© 2023 SecureBank. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </div>
</template> 