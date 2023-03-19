<template>
  <app-layout>
    <div class="flex flex-col">
      <main class="flex-1 overflow-y-auto focus:outline-none" tabindex="0">
        <div class="relative mx-auto max-w-4xl md:px-8 xl:px-0">
          <div class="pt-10 pb-16">
            <div class="px-4 sm:px-6 md:px-0">
              <h1 class="text-3xl font-extrabold leading-9 text-gray-900">Platform Settings</h1>
            </div>

            <admin-nav />

            <div class="mt-5 space-y-6 divide-y divide-gray-200">
              <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">New Institution</h3>
                <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                  Create a new Institution for users to connect accounts to.
                </p>
              </div>
              <div class="mt-6 sm:mt-5">
                <div
                  class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                >
                  <label
                    for="institution_name"
                    class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2"
                  >
                    Name
                  </label>
                  <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                      <input
                        id="institution_name"
                        v-model="form.institution_name"
                        class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      />
                    </div>
                  </div>
                </div>
                <div
                  class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:items-center sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                >
                  <label for="photo" class="block text-sm font-medium leading-5 text-gray-700">
                    Logo
                  </label>
                  <div class="mt-2 sm:col-span-2 sm:mt-0">
                    <div class="flex items-center">
                      <span class="h-12 w-12 overflow-hidden rounded-full bg-gray-100">
                        <img
                          v-show="showInstitutionImagePreview"
                          :src="institutionImagePreview"
                          class="h-full w-full rounded-full"
                        />
                        <svg
                          v-show="!showInstitutionImagePreview"
                          class="h-full w-full text-gray-300"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"
                          ></path>
                        </svg>
                      </span>
                      <span class="ml-5 rounded-md shadow-sm">
                        <input
                          id="institutionImage"
                          ref="institutionImageFile"
                          accept="image/*"
                          name="institution-image"
                          style="position: absolute; top: -500px"
                          type="file"
                          @change="handleInstitutionImageUpload()"
                        />
                        <button
                          type="button"
                          class="focus:shadow-outline-blue rounded-md border border-gray-300 py-2 px-3 text-sm font-medium leading-4 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-300 focus:outline-none active:bg-gray-50 active:text-gray-800"
                          @click="chooseInstitutionImage()"
                        >
                          Change
                        </button>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="mt-8 border-t border-gray-200 pt-5">
                  <div class="flex justify-end">
                    <span class="inline-flex rounded-md shadow-sm">
                      <Link
                        href="/admin/institutions"
                        class="focus:shadow-outline-blue rounded-md border border-gray-300 py-2 px-4 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-300 focus:outline-none active:bg-gray-50 active:text-gray-800"
                      >
                        Cancel
                      </Link>
                    </span>
                    <span class="ml-3 inline-flex rounded-md shadow-sm">
                      <button
                        type="button"
                        class="focus:shadow-outline-blue inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out hover:bg-blue-500 focus:border-blue-700 focus:outline-none active:bg-blue-700"
                        @click="store()"
                      >
                        Save
                      </button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </app-layout>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout';

export default {
  components: {
    AppLayout,
    Link,
  },
  props: ['csrf'],

  data() {
    return {
      showInstitutionImagePreview: false,
      institutionImagePreview: '',

      form: {
        institution_name: '',
        logo: '',
      },
    };
  },

  methods: {
    store() {
      const formData = new FormData();

      formData.append('institution_name', this.form.institution_name);
      formData.append('logo', this.form.logo[0]);
      formData.append('_token', this.csrf);

      this.$inertia.post('/admin/institutions', formData);
    },

    chooseInstitutionImage() {
      this.$refs.institutionImageFile.click();
    },

    handleInstitutionImageUpload() {
      this.form.logo = this.$refs.institutionImageFile.files;

      const reader = new FileReader();

      reader.addEventListener(
        'load',
        () => {
          this.showInstitutionImagePreview = true;
          this.institutionImagePreview = reader.result;
        },
        false,
      );

      if (this.form.logo) {
        if (/\.(jpe?g|png|gif)$/i.test(this.form.logo[0].name)) {
          reader.readAsDataURL(this.form.logo[0]);
        }
      }
    },
  },
};
</script>
