<template>
  <div>
    <!-- Generate API Token -->
    <jet-form-section @submitted="createApiToken">
      <template #title> Create API Token </template>

      <template #description>
        API tokens allow third-party services to authenticate with our application on your behalf.
      </template>

      <template #form>
        <!-- Token Name -->
        <div class="col-span-6 sm:col-span-4">
          <jet-label for="name" value="Name" />
          <jet-input
            id="name"
            v-model="createApiTokenForm.name"
            type="text"
            class="mt-1 block w-full"
            autofocus
          />
          <jet-input-error :message="createApiTokenForm.error('name')" class="mt-2" />
        </div>

        <!-- Token Permissions -->
        <div v-if="availablePermissions.length > 0" class="col-span-6">
          <jet-label for="permissions" value="Permissions" />

          <div class="mt-2 grid grid-cols-1 gap-4 md:grid-cols-2">
            <div v-for="permission in availablePermissions">
              <label class="flex items-center">
                <input
                  v-model="createApiTokenForm.permissions"
                  type="checkbox"
                  class="form-checkbox"
                  :value="permission"
                />
                <span class="ml-2 text-sm text-gray-600">{{ permission }}</span>
              </label>
            </div>
          </div>
        </div>
      </template>

      <template #actions>
        <jet-action-message :on="createApiTokenForm.recentlySuccessful" class="mr-3">
          Created.
        </jet-action-message>

        <jet-button
          :class="{ 'opacity-25': createApiTokenForm.processing }"
          :disabled="createApiTokenForm.processing"
        >
          Create
        </jet-button>
      </template>
    </jet-form-section>

    <div v-if="tokens.length > 0">
      <jet-section-border />

      <!-- Manage API Tokens -->
      <div class="mt-10 sm:mt-0">
        <jet-action-section>
          <template #title> Manage API Tokens </template>

          <template #description>
            You may delete any of your existing tokens if they are no longer needed.
          </template>

          <!-- API Token List -->
          <template #content>
            <div class="space-y-6">
              <div v-for="token in tokens" class="flex items-center justify-between">
                <div>
                  {{ token.name }}
                </div>

                <div class="flex items-center">
                  <div v-if="token.last_used_at" class="text-sm text-gray-400">
                    Last used {{ fromNow(token.last_used_at) }}
                  </div>

                  <button
                    v-if="availablePermissions.length > 0"
                    class="ml-6 cursor-pointer text-sm text-gray-400 underline focus:outline-none"
                    @click="manageApiTokenPermissions(token)"
                  >
                    Permissions
                  </button>

                  <button
                    class="ml-6 cursor-pointer text-sm text-red-500 focus:outline-none"
                    @click="confirmApiTokenDeletion(token)"
                  >
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </template>
        </jet-action-section>
      </div>
    </div>

    <!-- Token Value Modal -->
    <jet-dialog-modal :show="displayingToken" @close="displayingToken = false">
      <template #title> API Token </template>

      <template #content>
        <div>Please copy your new API token. For your security, it won't be shown again.</div>

        <div
          v-if="$page.jetstream.flash.token"
          class="mt-4 rounded bg-gray-100 px-4 py-2 font-mono text-sm text-gray-500"
        >
          {{ $page.jetstream.flash.token }}
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click.native="displayingToken = false"> Close </jet-secondary-button>
      </template>
    </jet-dialog-modal>

    <!-- API Token Permissions Modal -->
    <jet-dialog-modal :show="managingPermissionsFor" @close="managingPermissionsFor = null">
      <template #title> API Token Permissions </template>

      <template #content>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div v-for="permission in availablePermissions">
            <label class="flex items-center">
              <input
                v-model="updateApiTokenForm.permissions"
                type="checkbox"
                class="form-checkbox"
                :value="permission"
              />
              <span class="ml-2 text-sm text-gray-600">{{ permission }}</span>
            </label>
          </div>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click.native="managingPermissionsFor = null">
          Nevermind
        </jet-secondary-button>

        <jet-button
          class="ml-2"
          :class="{ 'opacity-25': updateApiTokenForm.processing }"
          :disabled="updateApiTokenForm.processing"
          @click.native="updateApiToken"
        >
          Save
        </jet-button>
      </template>
    </jet-dialog-modal>

    <!-- Delete Token Confirmation Modal -->
    <jet-confirmation-modal :show="apiTokenBeingDeleted" @close="apiTokenBeingDeleted = null">
      <template #title> Delete API Token </template>

      <template #content> Are you sure you would like to delete this API token? </template>

      <template #footer>
        <jet-secondary-button @click.native="apiTokenBeingDeleted = null">
          Nevermind
        </jet-secondary-button>

        <jet-danger-button
          class="ml-2"
          :class="{ 'opacity-25': deleteApiTokenForm.processing }"
          :disabled="deleteApiTokenForm.processing"
          @click.native="deleteApiToken"
        >
          Delete
        </jet-danger-button>
      </template>
    </jet-confirmation-modal>
  </div>
</template>

<script>
import JetActionMessage from '../../Jetstream/ActionMessage';
import JetActionSection from '../../Jetstream/ActionSection';
import JetButton from '../../Jetstream/Button';
import JetConfirmationModal from '../../Jetstream/ConfirmationModal';
import JetDangerButton from '../../Jetstream/DangerButton';
import JetDialogModal from '../../Jetstream/DialogModal';
import JetFormSection from '../../Jetstream/FormSection';
import JetInput from '../../Jetstream/Input';
import JetInputError from '../../Jetstream/InputError';
import JetLabel from '../../Jetstream/Label';
import JetSecondaryButton from '../../Jetstream/SecondaryButton';
import JetSectionBorder from '../../Jetstream/SectionBorder';

export default {
  components: {
    JetActionMessage,
    JetActionSection,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetDialogModal,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    JetSectionBorder,
  },

  props: ['tokens', 'availablePermissions', 'defaultPermissions'],

  data() {
    return {
      createApiTokenForm: this.$inertia.form(
        {
          name: '',
          permissions: this.defaultPermissions,
        },
        {
          bag: 'createApiToken',
          resetOnSuccess: true,
        },
      ),

      updateApiTokenForm: this.$inertia.form(
        {
          permissions: [],
        },
        {
          resetOnSuccess: false,
          bag: 'updateApiToken',
        },
      ),

      deleteApiTokenForm: this.$inertia.form(),

      displayingToken: false,
      managingPermissionsFor: null,
      apiTokenBeingDeleted: null,
    };
  },

  methods: {
    createApiToken() {
      this.createApiTokenForm
        .post('/user/api-tokens', {
          preserveScroll: true,
        })
        .then((response) => {
          if (!this.createApiTokenForm.hasErrors()) {
            this.displayingToken = true;
          }
        });
    },

    manageApiTokenPermissions(token) {
      this.updateApiTokenForm.permissions = token.abilities;

      this.managingPermissionsFor = token;
    },

    updateApiToken() {
      this.updateApiTokenForm
        .put(`/user/api-tokens/${this.managingPermissionsFor.id}`, {
          preserveScroll: true,
          preserveState: true,
        })
        .then((response) => {
          this.managingPermissionsFor = null;
        });
    },

    confirmApiTokenDeletion(token) {
      this.apiTokenBeingDeleted = token;
    },

    deleteApiToken() {
      this.deleteApiTokenForm
        .delete(`/user/api-tokens/${this.apiTokenBeingDeleted.id}`, {
          preserveScroll: true,
          preserveState: true,
        })
        .then(() => {
          this.apiTokenBeingDeleted = null;
        });
    },

    fromNow(timestamp) {
      return moment(timestamp).local().fromNow();
    },
  },
};
</script>
