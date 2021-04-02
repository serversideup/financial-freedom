<template>
    <div class="px-4 sm:px-6 md:px-0">
        <div class="py-6">
            <!-- Tabs -->
            <div class="lg:hidden">
                <select aria-label="Selected tab" class="mt-1 form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5 transition ease-in-out duration-150">
                    <option selected>General</option>
                    <option>Institutions</option>
                </select>
            </div>
            <div class="hidden lg:block">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex">
                        <a href="#" class="whitespace-no-wrap py-4 px-1 border-b-2 border-purple-500 font-medium text-sm leading-5 text-purple-600 focus:outline-none focus:text-purple-800 focus:border-purple-700">
                            General
                        </a>

                        <a href="/admin/institutions" class="whitespace-no-wrap ml-8 py-4 px-1 border-b-2 border-transparent font-medium text-sm leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
                            Institutions
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    
}
</script>