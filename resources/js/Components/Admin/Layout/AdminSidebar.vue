<template>
  <!-- Secondary sidebar -->
  <nav
    aria-label="Sections"
    class="border-blue-gray-200 hidden w-96 flex-shrink-0 border-r bg-white xl:flex xl:flex-col"
  >
    <div class="border-blue-gray-200 flex h-16 flex-shrink-0 items-center border-b px-6">
      <p class="text-blue-gray-900 text-lg font-medium">Settings</p>
    </div>
    <div class="min-h-0 flex-1 overflow-y-auto">
      <Link
        v-for="item in subNavigation"
        :key="item.name"
        :href="item.href"
        :class="[
          item.current ? 'bg-blue-50 bg-opacity-50' : 'hover:bg-blue-50 hover:bg-opacity-50',
          'border-blue-gray-200 flex border-b p-6',
        ]"
        :aria-current="item.current ? 'page' : undefined"
      >
        <img
          :src="item.icon"
          class="text-blue-gray-400 -mt-0.5 h-6 w-6 flex-shrink-0"
          aria-hidden="true"
        />
        <div class="ml-3 text-sm">
          <p class="font-medium text-gray-900">{{ item.name }}</p>
          <p class="mt-1 text-gray-500">{{ item.description }}</p>
        </div>
      </Link>
    </div>
  </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  components: {
    Link,
  },
  data() {
    return {
      subNavigation: [
        {
          name: 'Transactions',
          href: '/admin/transactions',
          current: window.location.href.includes('/admin/transactions'),
          icon: '/img/icons/cash.svg',
          description: 'Settings for how to organize and manage transactions',
        },
        {
          name: 'Institutions',
          href: '/admin/institutions',
          current: window.location.href.includes('/admin/institutions'),
          icon: '/img/icons/institution.svg',
          description: 'Manage financial institution settings',
        },
      ],
    };
  },
};
</script>
