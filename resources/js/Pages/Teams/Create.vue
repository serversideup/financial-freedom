<template>
  <app-layout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Create Team</h2>
    </template>

    <div>
      <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        <create-team-form />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout';
import CreateTeamForm from './CreateTeamForm';
import JetSectionBorder from '../../Jetstream/SectionBorder';

export default {
  components: {
    AppLayout,
    CreateTeamForm,
    JetSectionBorder,
  },
  props: ['team'],
};
</script>
