<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
  incidents: Object // Expect paginated data
})

const incidents = ref(props.incidents.data) // Store the data
const currentPage = ref(props.incidents.current_page)
const lastPage = ref(props.incidents.last_page)

const updateStatus = (incidentId, status) => {
  router.put(`/admin/reports/${incidentId}/resolve`, { status })
}

const getStatusColor = (status) => {
  switch(status) {
    case 'Pending': return 'bg-orange-100 text-orange-800'
    case 'On Progress': return 'bg-blue-100 text-blue-800'
    case 'Solved': return 'bg-green-100 text-green-800'
    default: return 'bg-gray-100 text-gray-800'
  }
}

const loadPage = (page) => {
  router.get(`/admin/reports?page=${page}`).then((response) => {
    incidents.value = response.data.data
    currentPage.value = response.data.current_page
    lastPage.value = response.data.last_page
  })
}
</script>

<template>
  <AuthenticatedLayout>
    <div class="p-6">
      <h1 class="mb-1 text-2xl font-bold">Admin Dashboard</h1>
      <p class="mb-6 text-gray-600">Manage and monitor incident reports from Barangay Ubojan residents</p>

      <!-- Report Summary Cards -->
      <div class="mb-8">
        <h2 class="mb-4 text-lg font-semibold text-gray-700">Report Summary</h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
          <div class="p-4 bg-white border rounded-lg shadow">
            <p class="text-sm text-gray-500">Pending Reports</p>
            <p class="mt-2 text-2xl font-bold">{{ incidents.filter(i => i.status === 'Pending').length }}</p>
            <a href="#" class="block mt-2 text-sm text-indigo-600 hover:underline">View pending reports →</a>
          </div>
          <div class="p-4 bg-white border rounded-lg shadow">
            <p class="text-sm text-gray-500">In Progress</p>
            <p class="mt-2 text-2xl font-bold">{{ incidents.filter(i => i.status === 'On Progress').length }}</p>
            <a href="#" class="block mt-2 text-sm text-indigo-600 hover:underline">View in-progress reports →</a>
          </div>
          <div class="p-4 bg-white border rounded-lg shadow">
            <p class="text-sm text-gray-500">Resolved Reports</p>
            <p class="mt-2 text-2xl font-bold">{{ incidents.filter(i => i.status === 'Solved').length }}</p>
            <a href="#" class="block mt-2 text-sm text-green-600 hover:underline">View resolved reports →</a>
          </div>
        </div>
      </div>

      <!-- Incident Cards -->
      <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <div
          v-for="incident in incidents"
          :key="incident.id"
          class="overflow-hidden bg-white rounded-lg shadow-md"
        >
          <div class="p-4 border-b">
            <div class="flex items-start justify-between">
              <h2 class="text-lg font-semibold">{{ incident.title }}</h2>
              <span
                :class="['px-2 py-1 text-xs font-medium rounded-full', getStatusColor(incident.status)]"
              >
                {{ incident.status }}
              </span>
            </div>
            <p class="mt-2 text-sm text-gray-600">{{ incident.description }}</p>
          </div>

          <div class="px-4 py-3 bg-gray-50">
            <div class="flex items-center text-sm text-gray-500">
              <span>Reported by: <span class="font-medium">{{ incident.user.name }}</span></span>
            </div>
            <div class="mt-1 text-sm text-gray-500">
              <span>{{ new Date(incident.created_at).toLocaleString() }}</span>
            </div>
          </div>

          <div class="flex p-3 space-x-2 border-t">
            <button
              class="flex-1 px-3 py-2 text-sm font-medium text-white transition bg-yellow-500 rounded-md hover:bg-yellow-600"
              @click="updateStatus(incident.id, 'On Progress')"
            >
              Set On Progress
            </button>
            <button
              class="flex-1 px-3 py-2 text-sm font-medium text-white transition bg-green-500 rounded-md hover:bg-green-600"
              @click="updateStatus(incident.id, 'Solved')"
            >
              Set Solved
            </button>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="flex items-center justify-between mt-6">
        <button
          class="px-4 py-2 text-white bg-blue-500 rounded-lg"
          :disabled="currentPage === 1"
          @click="loadPage(currentPage - 1)"
        >
          Previous
        </button>
        <p>Page {{ currentPage }} of {{ lastPage }}</p>
        <button
          class="px-4 py-2 text-white bg-blue-500 rounded-lg"
          :disabled="currentPage === lastPage"
          @click="loadPage(currentPage + 1)"
        >
          Next
        </button>
      </div>

      <div v-if="incidents.length === 0" class="p-8 mt-6 text-center bg-white rounded-lg shadow">
        <p class="text-gray-500">No reports found</p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
