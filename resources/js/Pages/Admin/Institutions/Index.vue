<template>
    <admin-layout>
        <div class="flex-1 max-h-screen xl:overflow-y-auto">
            <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:py-12 lg:px-8">
                <h1 class="text-3xl font-extrabold text-gray-900">Institutions</h1>
                
                <ul role="list" class="divide-y divide-gray-200 max-w-xl">
                    <li class="py-4 flex items-center justify-between" 
                        v-for="institution in institutions"
                        :key="'institution-'+institution.id">
                        <div class="flex items-center">
                            <img class="h-10 w-10 rounded-full" :src="institution.logo" alt="">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900" v-text="institution.name"></p>
                                <p class="text-sm text-gray-500"></p>
                            </div>
                        </div>
                        <Link :href="'/admin/institutions/'+institution.id+'/edit'" class=" inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Manage</Link>
                    </li>
                </ul>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'
    import { Link } from '@inertiajs/inertia-vue3';

    export default {
        props: [
            'institutions'
        ],

        components: {
            AdminLayout,
            Link
        }
    }
</script>