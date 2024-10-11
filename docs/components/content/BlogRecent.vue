<template>
    <div class="w-full py-12 border-b border-[#212733] mt-20 lg:mt-32">
        <div class="w-full max-w-screen-xl mx-auto px-4 lg:px-10">
            <NuxtLink :to="recentPost._path" class="hover:bg-[#161B26] rounded-lg md:p-4 w-full flex flex-col md:flex-row items-center space-x-4 cursor-pointer">
                <div class="flex flex-col w-full md:w-1/2 lg:w-2/5">
                    <img :src="recentPost.og_image" class="w-full rounded-lg border border-[#212733]" />
                </div>
                <div class="flex flex-col w-full md:w-1/2 lg:w-3/5">
                    <div class="text-[#94969C] text-sm font-medium mt-2">{{ formatPublishedAt(recentPost.published_at) }}</div>
                    <h2 class="font-sans font-bold text-2xl text-[#F5F5F6]">{{ recentPost.title }}</h2>
                    <p class="text-[#CECFD2] text-base font-medium mt-2">{{ recentPost.description }}</p>
                    <div class="flex items-center mt-5 text-[#F5F5F6] text-sm font-medium">{{ recentPost.author.name }}</div>
                </div>
            </NuxtLink>
        </div>
    </div>
</template>

<script setup>
const { data: recentPost, pending } = await useAsyncData('recentPost', () => queryContent("blog")
    .sort({ published_at: -1 })
    .where({ _path: { $ne: "/blog" } })
    .findOne());

const formatPublishedAt = (date) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('en-US', options);
}
</script>