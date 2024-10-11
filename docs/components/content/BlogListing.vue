<template>
    <div class="w-full py-12">
        <div class="w-full max-w-screen-xl mx-auto px-4 md:px-10 flex flex-col">
            <div class="w-full md:hidden">
                <label for="category" class="text-sm text-[#F5F5F6] font-semibold">Filter by category</label>
                <select class="bg-[#161B26] rounded-md border border-[#333741] font-semibold text-sm text-[#CECFD2] py-[10px] pl-2 pr-9 mt-2 w-full"
                    @change="setActiveCategory($event.target.value)"
                    v-model="activeCategory">
                        <option value="all">All</option>
                        <option value="development">Development</option>
                        <option value="product">Product</option>
                        <option value="design">Design</option>
                        <option value="financial-independence">Financial Independence</option>
                </select>
            </div>
            <div class="w-full items-center justify-between hidden md:flex">
                <div class="flex flex-wrap items-center">
                    <button @click="setActiveCategory('all')" class="text-xs ml-2 mb-2 text-[#F5F5F6] border border-[#212733] hover:border-gray-500 rounded-full px-2.5 ease-out duration-200 outline-none"
                        :class="{ 'bg-[#212733] border-gray-500': activeCategory === 'all' }">
                        All
                    </button>
                    <button @click="setActiveCategory('development')" class="text-xs ml-2 mb-2 text-[#F5F5F6] border border-[#212733] hover:border-gray-500 rounded-full px-2.5 ease-out duration-200 outline-none"
                        :class="{ 'bg-[#212733] border-gray-500': activeCategory === 'development' }">
                        Development
                    </button>
                    <button @click="setActiveCategory('product')" class="text-xs ml-2 mb-2 text-[#F5F5F6] border border-[#212733] hover:border-gray-500 rounded-full px-2.5 ease-out duration-200 outline-none"
                        :class="{ 'bg-[#212733] border-gray-500': activeCategory === 'product' }">
                        Product
                    </button>
                    <button @click="setActiveCategory('design')" class="text-xs ml-2 mb-2 text-[#F5F5F6] border border-[#212733] hover:border-gray-500 rounded-full px-2.5 ease-out duration-200 outline-none"
                        :class="{ 'bg-[#212733] border-gray-500': activeCategory === 'design' }">
                        Design
                    </button>
                    <button @click="setActiveCategory('financial-independence')" class="text-xs ml-2 mb-2 text-[#F5F5F6] border border-[#212733] hover:border-gray-500 rounded-full px-2.5 ease-out duration-200 outline-none"
                        :class="{ 'bg-[#212733] border-gray-500': activeCategory === 'financial-independence' }">
                        Financial Independence
                    </button>
                </div>
            </div>

            <div class="w-full mt-5 md:mt-10">
                <NuxtLink class="w-full grid grid-cols-12 border-b border-[#212733] py-4 group"
                    v-for="blog in blogs"
                    :to="blog._path">
                    <div class="col-span-12 md:col-span-6 text-[#F5F5F6] font-regular text-xl group-hover:underline">
                        {{ blog.title }}
                    </div>
                    
                    <div class="hidden col-span-12 md:col-span-2 text-[#F5F5F6] font-regular text-sm md:flex items-center justify-center">
                        <img :src="blog.author.image" class="w-6 h-6 rounded-full" />
                    </div>
                    
                    <div class="hidden mt-1 md:mt-0 col-span-6 md:col-span-2 text-[#F5F5F6] font-regular text-sm md:flex items-center md:justify-center">
                        <p class="inline-flex capitalize text-xs text-[#F5F5F6] border border-[#212733] hover:border-gray-500 rounded-full px-2.5 ease-out duration-200 outline-none group-hover:bg-[#212733] group-hover:border-gray-500">
                            {{ blog.category }}
                        </p>
                    </div>
                    
                    <div class="mt-1 md:mt-0 col-span-6 md:col-span-2 text-[#F5F5F6] font-regular text-sm flex items-center md:justify-end">
                        {{ formatPublishedAt(blog.published_at) }}
                    </div>
                </NuxtLink>
            </div>
        </div>
    </div>
</template>

<script setup>
const activeCategory = ref('all');
const categories = ref(['financial-independence', 'development', 'product', 'design']);


const { data: blogs, refresh } = await useAsyncData('blogs', () => queryContent("blog")
    .sort({ published_at: -1 })
    .where({ _path: { $ne: "/blog" }})
    .where({ 'category': { $in: categories.value }})
    .find());

watch(categories, () => {
    refresh();
});

const formatPublishedAt = (date) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('en-US', options);
}

const setActiveCategory = (category) => {
    activeCategory.value = category;

    if( activeCategory.value !== 'all' ){
        categories.value = [activeCategory.value];
    }else{
        categories.value = ['financial-independence', 'development', 'product', 'design'];
    }
}
</script>