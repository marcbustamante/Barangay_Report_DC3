<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  incident: Object
})
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Incident Details</h2>
    </template>

    <div class="py-12">
      <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">{{ incident.title }}</h3>
            <p class="mb-2"><strong>Status:</strong> {{ incident.status }}</p>
            <p class="mb-2"><strong>Description:</strong></p>
            <p class="text-gray-700 whitespace-pre-wrap">{{ incident.description }}</p>

            <div class="mt-6">
              <Link href="/incidents" class="text-blue-600 hover:underline">← Back to List</Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
