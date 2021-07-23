<template>
    <!-- Secondary sidebar -->
    <nav aria-label="Sections" class="hidden flex-shrink-0 w-96 bg-white border-r border-blue-gray-200 xl:flex xl:flex-col">
        <div class="flex-shrink-0 h-16 px-6 border-b border-blue-gray-200 flex items-center">
            <p class="text-lg font-medium text-blue-gray-900">Settings</p>
        </div>
        <div class="flex-1 min-h-0 overflow-y-auto">
            <inertia-link v-for="item in subNavigation" 
                :key="item.name" 
                :href="item.href" 
                :class="[item.current ? 'bg-blue-50 bg-opacity-50' : 'hover:bg-blue-50 hover:bg-opacity-50', 'flex p-6 border-b border-blue-gray-200']" 
                :aria-current="item.current ? 'page' : undefined">
                    <img :src="item.icon" class="flex-shrink-0 -mt-0.5 h-6 w-6 text-blue-gray-400" aria-hidden="true" />
                    <div class="ml-3 text-sm">
                        <p class="font-medium text-gray-900">{{ item.name }}</p>
                        <p class="mt-1 text-gray-500">{{ item.description }}</p>
                </div>
            </inertia-link>
        </div>
    </nav>
</template>

<script>
export default {
    data(){
        return {
            subNavigation: [
                {
                    name: 'Transactions',
                    href: '/admin/transactions',
                    current: window.location.href.includes('/admin/transactions'),
                    icon: '/img/icons/cash.svg',
                    description: 'Settings for how to organize and manage transactions'
                },
                {
                    name: 'Institutions',
                    href: '/admin/institutions',
                    current: window.location.href.includes('/admin/institutions'),
                    icon: '/img/icons/institution.svg',
                    description: 'Manage financial institution settings'
                }                
            ]
        }
    }
}
</script>