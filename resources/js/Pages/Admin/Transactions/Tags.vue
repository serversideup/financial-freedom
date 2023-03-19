<template>
  <admin-layout>
    <div class="max-h-screen flex-1 xl:overflow-y-auto">
      <div class="mx-auto max-w-5xl py-10 px-4 sm:px-6 lg:py-12 lg:px-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Transactions</h1>

        <p class="mb-5 font-sans text-gray-700">
          Manage settings related to how transactions categorized, tagged and customized.
        </p>

        <sub-navigation :active="'tags'" />

        <tags-table :tags="tags" />
      </div>
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from '../../../Layouts/AdminLayout';
import TagsTable from '../../../Components/Admin/Transactions/TagsTable';
import SubNavigation from '../../../Components/Admin/Transactions/SubNavigation';

export default {
  components: {
    AdminLayout,
    TagsTable,
    SubNavigation,
  },
  props: ['tags'],
};
</script>
