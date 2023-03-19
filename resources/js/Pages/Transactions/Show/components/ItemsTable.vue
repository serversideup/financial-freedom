<template>
  <div class="mx-auto mt-10 w-full max-w-screen-md">
    <h3
      class="mb-5 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:leading-9"
    >
      Items
    </h3>
    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th
                    scope="col"
                    class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                  >
                    Name
                  </th>
                  <th
                    scope="col"
                    class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                  >
                    Title
                  </th>
                  <th
                    scope="col"
                    class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                  >
                    Email
                  </th>
                  <th
                    scope="col"
                    class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                  >
                    Role
                  </th>
                  <th scope="col" class="bg-gray-50 px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr>
                  <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                    Jane Cooper
                  </td>
                  <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                    Regional Paradigm Technician
                  </td>
                  <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                    jane.cooper@example.com
                  </td>
                  <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">Admin</td>
                  <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                    <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                  </td>
                </tr>

                <!-- More rows... -->
              </tbody>
            </table>
            <svg
              class="h-6 w-6"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
              ></path>
            </svg>
            Need an add item row here<br />
            Split transaction? If you don't want to add items?
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
