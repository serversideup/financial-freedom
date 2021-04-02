<template>
    <app-layout>
        <div class="flex flex-col">
            <main class="flex-1 overflow-y-auto focus:outline-none" tabindex="0">
                <div class="relative max-w-4xl mx-auto md:px-8 xl:px-0">
                    <div class="pt-10 pb-16">
                        <div class="px-4 sm:px-6 md:px-0">
                            <h1 class="text-3xl leading-9 font-extrabold text-gray-900">Platform Settings</h1>
                        </div>
                        <admin-nav/>
                        <div class="mt-5 space-y-6 divide-y divide-gray-200">
                            <div class="space-y-3 sm:flex sm:items-center sm:justify-between sm:space-x-4 sm:space-y-0">
                                <div class="flex flex-col">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Institutions
                                    </h3>
                                    <p class="max-w-2xl text-sm leading-5 text-gray-500">
                                        Users can create an account with these institutions.
                                    </p>
                                </div>
                                <div>
                                    <span class="shadow-sm rounded-md">
                                        <a href="/admin/institutions/create" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-700 active:bg-indigo-700 transition duration-150 ease-in-out">
                                            Add institution
                                        </a>
                                    </span>
                                </div>
                            </div>

                            <ul class="divide-y divide-gray-200">
                                <li class="py-4 flex space-x-3" 
                                    v-for="( institution, key ) in institutions"
                                    v-bind:key="'institution-'+key">
                                        <img class="h-10 w-10 rounded-full" :src="institution.logo" alt="">
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex flex-col">
                                                <span class="text-sm leading-5 font-medium text-gray-900">{{ institution.name }}</span>
                                                <span class="text-sm leading-5 text-gray-500"></span>
                                            </div>
                                            <inertia-link class="text-sm underline text-gray-900" :href="'/admin/institutions/'+institution.id+'/edit'">Manage</inertia-link>
                                        </div>
                                </li>
                            </ul>
                        </div>
        			</div>
      			</div>
			</main>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../../Layouts/AppLayout'
    import AdminNav from './../../../Components/Admin/Layout/AdminNav'

    export default {
        props: [
            'institutions'
        ],

        components: {
            AppLayout,
            AdminNav
        }
    }
</script>