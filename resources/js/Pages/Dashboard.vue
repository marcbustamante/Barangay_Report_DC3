<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold text-teal-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12 bg-gradient-to-br from-cyan-200 via-blue-100 to-teal-200 min-h-screen">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="backdrop-blur-xl bg-white/60 border border-white/20 shadow-2xl rounded-2xl p-10 transition-transform hover:scale-[1.02] duration-300"
                >
                    <h3 class="text-3xl font-extrabold text-teal-800 mb-3">Welcome Back 👋</h3>
                    <p class="text-gray-800 mb-5">
                        You’re securely logged in. Let’s make today productive.
                    </p>
                    <button
                        class="bg-teal-600 text-white px-6 py-2 rounded-lg hover:bg-teal-700 transition duration-200"
                    >
                        Start Exploring
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
