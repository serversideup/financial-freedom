<template>
  <jet-form-section @submitted="updateTeamName">
    <template #title> Team Name </template>

    <template #description> The team's name and owner information. </template>

    <template #form>
      <!-- Team Owner Information -->
      <div class="col-span-6">
        <jet-label value="Team Owner" />

        <div class="mt-2 flex items-center">
          <img
            class="h-12 w-12 rounded-full object-cover"
            :src="team.owner.profile_photo_url"
            :alt="team.owner.name"
          />

          <div class="ml-4 leading-tight">
            <div>{{ team.owner.name }}</div>
            <div class="text-sm text-gray-700">{{ team.owner.email }}</div>
          </div>
        </div>
      </div>

      <!-- Team Name -->
      <div class="col-span-6 sm:col-span-4">
        <jet-label for="name" value="Team Name" />

        <jet-input
          id="name"
          v-model="form.name"
          type="text"
          class="mt-1 block w-full"
          :disabled="!permissions.canUpdateTeam"
        />

        <jet-input-error :message="form.error('name')" class="mt-2" />
      </div>
    </template>

    <template v-if="permissions.canUpdateTeam" #actions>
      <jet-action-message :on="form.recentlySuccessful" class="mr-3"> Saved. </jet-action-message>

      <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Save
      </jet-button>
    </template>
  </jet-form-section>
</template>

<script>
import JetActionMessage from '../../Jetstream/ActionMessage';
import JetButton from '../../Jetstream/Button';
import JetFormSection from '../../Jetstream/FormSection';
import JetInput from '../../Jetstream/Input';
import JetInputError from '../../Jetstream/InputError';
import JetLabel from '../../Jetstream/Label';

export default {
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
  },

  props: ['team', 'permissions'],

  data() {
    return {
      form: this.$inertia.form(
        {
          name: this.team.name,
        },
        {
          bag: 'updateTeamName',
          resetOnSuccess: false,
        },
      ),
    };
  },

  methods: {
    updateTeamName() {
      this.form.put(`/teams/${this.team.id}`, {
        preserveScroll: true,
      });
    },
  },
};
</script>
