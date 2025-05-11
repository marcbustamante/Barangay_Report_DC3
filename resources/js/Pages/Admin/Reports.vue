<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({
  incidents: Array
})

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
</script>

<template>
  <AuthenticatedLayout>
    <div class="p-6">
      <h1 class="mb-6 text-2xl font-bold">Admin Reports</h1>

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

      <div v-if="incidents.length === 0" class="p-8 text-center bg-white rounded-lg shadow">
        <p class="text-gray-500">No reports found</p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
