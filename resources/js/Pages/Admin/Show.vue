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
        			</div>
      			</div>
			</main>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import AdminNav from './../../Components/Admin/Layout/AdminNav'

    export default {
        components: {
            AppLayout,
            AdminNav
        }
    }
</script>