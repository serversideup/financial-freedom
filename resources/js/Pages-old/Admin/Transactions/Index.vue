<template>
    <admin-layout>
        <div class="flex-1 max-h-screen xl:overflow-y-auto">
            <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:py-12 lg:px-8">
                <h1 class="text-3xl font-extrabold text-gray-900">Transactions</h1>

                <p class="font-sans text-gray-700 mb-5">Manage settings related to how transactions categorized, tagged and customized.</p>

                <sub-navigation
                    :active="'settings'"/>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from './../../../Layouts/AdminLayout'
    import SubNavigation from '../../../Components/Admin/Transactions/SubNavigation.vue';

    export default {
        components: {
            AdminLayout,
            SubNavigation
        }
    }
</script>