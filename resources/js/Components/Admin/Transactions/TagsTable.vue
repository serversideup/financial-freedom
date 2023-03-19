<template>
  <div>
    <h2 class="mt-5 mb-2 text-xl font-extrabold text-gray-900">Tags</h2>
    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                  >
                    Preview
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                  >
                    Name
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                  >
                    Color
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="(tag, index) in availableTags" :key="'tag-' + tag.id">
                  <th scope="col" class="whitespace-nowrap px-6 py-3 text-left text-sm">
                    <span
                      class="mr-1 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
                      :class="['bg-' + tag.color + '-100', 'text-' + tag.color + '-800']"
                    >
                      {{ tag.name }}
                    </span>
                  </th>
                  <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                    <input
                      v-model="availableTags[index].name"
                      type="text"
                      class="block w-full min-w-0 flex-1 rounded-md border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    />
                  </td>
                  <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                    <select
                      id="type"
                      v-model="availableTags[index].color"
                      class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
                    >
                      <option value=""></option>
                      <option value="red">Red</option>
                      <option value="green">Green</option>
                      <option value="blue">Blue</option>
                      <option value="gray">Gray</option>
                      <option value="purple">Purple</option>
                      <option value="pink">Pink</option>
                      <option value="orange">Orange</option>
                    </select>
                  </td>
                  <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                    <button
                      type="button"
                      class="text-blue-600 hover:text-blue-900"
                      @click="updateTag(index)"
                    >
                      Update
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TagsAPI from '../../../api/tags.js';
import { EventBus } from '../../../event-bus.js';

export default {
  props: ['tags'],

  data() {
    return {
      availableTags: [],
    };
  },

  mounted() {
    this.availableTags = JSON.parse(JSON.stringify(this.tags));
  },

  methods: {
    updateTag(index) {
      TagsAPI.update(this.availableTags[index].id, {
        name: this.availableTags[index].name,
        color: this.availableTags[index].color,
      }).then((response) => {
        EventBus.emit('notifiy', {
          type: 'success',
          title: 'Tag updated',
          message: 'Your tag meta has been updated',
          action: 'close',
        });
      });
    },
  },
};
</script>
