<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Ubojan Incident Report System" />
    <div class="bg-gray-50 min-h-screen text-gray-900">
        <div class="flex flex-col items-center justify-center min-h-screen px-6 py-12">
            <div class="relative w-full max-w-7xl">
                <header class="grid items-center grid-cols-2 gap-4 py-10 sm:grid-cols-3">
                    <div class="flex lg:col-start-2 lg:justify-center">
                        <div class="text-center">
                            <h1 class="text-5xl font-semibold text-teal-700 transition-all ease-in-out hover:text-teal-600">
                                Ubojan
                            </h1>
                            <p class="text-xl font-light text-gray-600">Incident Report System</p>
                        </div>
                    </div>
                    <nav v-if="canLogin" class="flex justify-end flex-1 space-x-6">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="text-gray-800 hover:text-teal-600 transition-all"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="text-gray-800 hover:text-teal-600 transition-all"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="text-gray-800 hover:text-teal-600 transition-all"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="mt-10">
                    <div class="max-w-3xl mx-auto text-center">
                        <p class="text-lg text-gray-700 leading-relaxed">
                            A comprehensive system for reporting and managing incidents.
                        </p>
                        <div class="grid grid-cols-1 gap-6 mt-8 sm:grid-cols-2">
                            <div class="p-6 border border-gray-300 rounded-xl shadow-xl hover:shadow-2xl transition-all bg-white">
                                <h3 class="mb-3 text-2xl font-semibold text-teal-700">Report Incidents</h3>
                                <p class="text-gray-600">Quickly submit incident reports with all necessary details.</p>
                            </div>
                            <div class="p-6 border border-gray-300 rounded-xl shadow-xl hover:shadow-2xl transition-all bg-white">
                                <h3 class="mb-3 text-2xl font-semibold text-teal-700">Track Progress</h3>
                                <p class="text-gray-600">Monitor the status of reported incidents in real-time.</p>
                            </div>
                        </div>
                    </div>
                </main>

                <footer class="py-12 text-sm text-center text-gray-600 mt-12">
                    Ubojan Incident Report System 2025
                </footer>
            </div>
        </div>
    </div>
</template>
