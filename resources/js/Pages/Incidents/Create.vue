<script setup>
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link } from '@inertiajs/vue3'

const form = useForm({
  title: '',
  description: '',
})

const submit = () => {
  form.post('/incidents')
}
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-teal-800">Report an Incident</h2>
        <Link
          href="/incidents"
          class="flex items-center px-4 py-2 font-medium text-white transition duration-150 ease-in-out bg-teal-600 rounded-md shadow hover:bg-teal-700"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
          </svg>
          Back to Incidents
        </Link>
      </div>
    </template>

    <div class="py-12 bg-gradient-to-br from-teal-200 via-blue-100 to-teal-200 min-h-screen">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
          class="backdrop-blur-xl bg-white/60 border border-white/30 shadow-2xl rounded-2xl p-10 transition-transform hover:scale-[1.02] duration-300"
        >
          <form @submit.prevent="submit" class="space-y-6">
            <div>
              <label for="title" class="block text-sm font-medium text-teal-800">Incident Title</label>
              <div class="mt-1">
                <input
                  id="title"
                  type="text"
                  v-model="form.title"
                  placeholder="Enter a descriptive title"
                  class="block w-full p-2 border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                  :class="{'border-red-500': form.errors.title}"
                />
                <p v-if="form.errors.title" class="mt-1 text-sm text-red-600">{{ form.errors.title }}</p>
              </div>
            </div>

            <div>
              <label for="description" class="block text-sm font-medium text-teal-800">Description</label>
              <div class="mt-1">
                <textarea
                  id="description"
                  v-model="form.description"
                  rows="5"
                  placeholder="Provide detailed information about the incident"
                  class="block w-full p-2 border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                  :class="{'border-red-500': form.errors.description}"
                ></textarea>
                <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description }}</p>
              </div>
              <p class="mt-2 text-sm text-teal-600">
                Please include relevant details such as time, location, and people involved.
              </p>
            </div>

            <div class="flex justify-end">
              <Link
                href="/incidents"
                class="px-4 py-2 mr-3 text-sm font-medium text-teal-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500"
              >
                Cancel
              </Link>
              <button
                type="submit"
                class="flex items-center px-4 py-2 text-sm font-medium text-white bg-teal-600 border border-transparent rounded-md shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500"
                :disabled="form.processing"
              >
                <svg v-if="form.processing" class="w-4 h-4 mr-2 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ form.processing ? 'Submitting...' : 'Submit Incident Report' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
