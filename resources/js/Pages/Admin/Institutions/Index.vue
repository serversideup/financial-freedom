<template>
  <admin-layout>
    <div class="max-h-screen flex-1 xl:overflow-y-auto">
      <div class="mx-auto max-w-5xl py-10 px-4 sm:px-6 lg:py-12 lg:px-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Institutions</h1>

        <ul role="list" class="max-w-xl divide-y divide-gray-200">
          <li
            v-for="institution in institutions"
            :key="'institution-' + institution.id"
            class="flex items-center justify-between py-4"
          >
            <div class="flex items-center">
              <img class="h-10 w-10 rounded-full" :src="institution.logo" alt="" />
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-900" v-text="institution.name"></p>
                <p class="text-sm text-gray-500"></p>
              </div>
            </div>
            <Link
              :href="'/admin/institutions/' + institution.id + '/edit'"
              class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
              >Manage</Link
            >
          </li>
        </ul>
      </div>
    </div>
  </admin-layout>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import AdminLayout from '@/Layouts/AdminLayout';

export default {
  components: {
    AdminLayout,
    Link,
  },
  props: ['institutions'],
};
</script>
