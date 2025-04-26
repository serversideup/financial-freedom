<template>
    <div class="w-full flex flex-col min-h-screen scroll-smooth bg-[#0C111D]">
        <Head>
            <Link rel="preconnect" href="https://fonts.googleapis.com"/>
            <Link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
            <Link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
            <Link rel="apple-touch-icon" sizes="180x180" :href="( basePath != '/' ? basePath : '' )+'/images/favicon/apple-touch-icon.png'"/>
            <Link rel="icon" type="image/png" sizes="32x32" :href="( basePath != '/' ? basePath : '' )+'/images/favicon/favicon-32x32.png'"/>
            <Link rel="icon" type="image/png" sizes="16x16" :href="( basePath != '/' ? basePath : '' )+'/images/favicon/favicon-16x16.png'"/>
            <Link rel="manifest" :href="( basePath != '/' ? basePath : '' )+'/images/favicon/site.webmanifest'"/>
            <Link rel="mask-icon" :href="( basePath != '/' ? basePath : '' )+'/images/favicon/safari-pinned-tab.svg'" color="#5bbad5"/>
            <Meta name="msapplication-TileColor" content="#da532c"/>
            <Meta name="theme-color" content="#ffffff"/>
        </Head>
        
        <GlobalServerSideUp
            :fixed="true"/>

        <MarketingHeader
            :fixed="true"/>
  
		<div class="pt-[120px] max-w-7xl w-full mx-auto grid grid-cols-12 gap-4 px-4 md:px-6 lg:px-20 justify-center mt-14">
            <div class="col-span-12 lg:col-span-2">
				<NuxtLink class="font-sans text-sm text-white" :href="'/blog'">
					&larr; All Posts
				</NuxtLink>
			</div>
			<div class="col-span-12 lg:col-span-10">
                <div class="mb-4 text-sm text-slate-400">
                    <span class="capitalize">{{ page.category }}</span> · {{ formatPublishedAt(page.published_at) }}
                </div>
                <h1 class="w-full font-semibold text-white text-[40px]/[44px] mb-6">
                    {{ page.title }}
                </h1>
                <div class="flex flex-col mb-12 md:flex-row md:items-center md:justify-between">
					<div class="flex items-center">
						<img :src="page.author.image" class="w-10 h-10 mr-2 rounded-full"/>
  
						<div class="flex flex-col">
							<span class="text-sm font-normal text-white">
								{{ page.author.name }}
							</span>
							<a :href="'https://x.com/' + page.author.x" class="text-sm text-slate-400"><span>@</span>{{ page.author.x }}</a>
						</div>
					</div>
				</div>

				<div class="grid grid-cols-12 gap-4">
					<div class="col-span-12 md:col-span-8">
						<ContentDoc class="prose prose-invert" />
					</div>

					<div class="col-span-12 md:col-span-4 flex flex-col mt-8 md:mt-0">
						<span class="text-sm font-normal text-white">Share this article</span>
						<div class="flex items-center space-x-2 text-white mt-4">
							<SocialShare network="facebook" :styled="true" :label="false"/>
							<SocialShare network="twitter" :styled="true" :label="false"/>
							<SocialShare network="linkedin" :styled="true" :label="false"/>
						</div>
					</div>
				</div>
            </div>
        </div>

		<LandingSignup />

		<MarketingFooter />
<!--   
      <NewsletterSubscribe />
  
      <LatestPosts />
  
      <GlobalFooter /> -->
    </div>
  </template>
  
<script setup>
const route = useRoute();
const { page } = useContent()
const { basePath, domain } = useRuntimeConfig().public;
  
  
const formatPublishedAt = (date) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('en-US', options);
}
  
  
//   useSeoMeta({
//     ogLocale: "en_US",
//     ogType: "website",
//     ogTitle: page.value?.title + " - Blog - Bugflow",
//     ogDescription: page.value?.excerpt,
//     ogUrl: baseUrl + route.path,
//     ogSiteName: "Bugflow - Bug Tracking & Visual Feedback Tool",
//     ogImage: baseUrl + page.value?.og_image,
//     ogImageWidth: 1146,
//     ogImageHeight: 600,
//     ogImageAlt: page.value?.title,
//     twitterCard: "summary_large_image",
//     twitterSite: "@getbugflow",
//     twitterImage: baseUrl + page.value?.og_image,
//     twitterImageAlt: page.value?.title,
//     twitterTitle: page.value?.title,
//     twitterDescription: page.value?.excerpt,
//   })
  </script>
  