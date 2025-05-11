<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'
import { ref } from 'vue'

defineProps({ incidents: Array })

const logout = () => {
  Inertia.post('/logout')
}

const deleteIncident = (id) => {
  if (confirm('Are you sure you want to delete this incident?')) {
    Inertia.delete(`/incidents/${id}`)
  }
}

const statusColors = {
  'Open': 'bg-yellow-100 text-yellow-800',
  'In Progress': 'bg-blue-100 text-blue-800',
  'Resolved': 'bg-green-100 text-green-800',
  'Closed': 'bg-gray-100 text-gray-800',
  'Critical': 'bg-red-100 text-red-800'
}

const getStatusColor = (status) => {
  return statusColors[status] || 'bg-gray-100 text-gray-800'
}
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-teal-800">Incident Reports</h2>
        <Link
          href="/incidents/create"
          class="flex items-center px-4 py-2 font-medium text-white transition duration-150 ease-in-out bg-teal-600 rounded-md shadow hover:bg-teal-700"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
          </svg>
          Report New Incident
        </Link>
      </div>
    </template>

    <div class="py-12 bg-gradient-to-br from-teal-200 via-blue-100 to-teal-200 min-h-screen">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
          class="backdrop-blur-xl bg-white/60 border border-white/30 shadow-2xl rounded-2xl p-10 transition-transform hover:scale-[1.02] duration-300"
        >
          <div class="p-6">
            <div v-if="incidents && incidents.length > 0">
              <div class="overflow-hidden border rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-teal-50">
                    <tr>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-teal-600 uppercase">Title</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-teal-600 uppercase">Status</th>
                      <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-right text-teal-600 uppercase">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="incident in incidents" :key="incident.id" class="hover:bg-teal-50">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ incident.title }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span :class="[getStatusColor(incident.status), 'px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full']">
                          {{ incident.status }}
                        </span>
                      </td>
                      <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                        <Link :href="`/incidents/${incident.id}`" class="mr-3 text-teal-600 hover:text-teal-900">View</Link>
                        <button
                          @click="deleteIncident(incident.id)"
                          class="text-red-600 hover:text-red-800"
                        >
                          Delete
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div v-else class="py-12 text-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <h3 class="mt-2 text-sm font-medium text-gray-900">No incidents found</h3>
              <p class="mt-1 text-sm text-gray-500">Get started by creating a new incident report</p>
              <div class="mt-6">
                <Link
                  href="/incidents/create"
                  class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-teal-600 border border-transparent rounded-md shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 -ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                  </svg>
                  New Incident
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
