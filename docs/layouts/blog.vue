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

        <div class="w-full flex flex-col">
            <slot></slot>
        </div>

        <LandingSignup />
		<MarketingFooter />
    </div>
</template>

<script setup>
useHead({
    htmlAttrs: {
        lang: 'en'
    },
    bodyAttrs: {
        class: 'antialiased'
    },
    title: 'Financial Freedom - An open source alternative to Mint, YNAB, and more. Stay on budget and build wealth without sacrificing your privacy.',
    script: [
        {
            src: 'https://f.convertkit.com/ckjs/ck.5.js'
        }
    ]
})

const route = useRoute();
const { basePath, domain } = useRuntimeConfig().public;

useSeoMeta({
    ogLocale: 'en_US',
    ogUrl: domain+basePath+route.path,
    ogType: 'website',
    ogSiteName: 'Financial Freedom - An open source alternative to Mint, YNAB, and more.',
    ogImage: domain+basePath+'/images/social-image.png',
    ogImageWidth: 1200,
    ogImageHeight: 627,
    ogImageType: 'image/png',
    ogDescription: 'An open source alternative to Mint, YNAB, and more. Stay on budget and build wealth without sacrificing your privacy.',
    ogTitle: 'Financial Freedom - An open source alternative to Mint, YNAB, and more.',
    twitterCard: 'summary_large_image',
    twitterDescription: 'An open source alternative to Mint, YNAB, and more. Stay on budget and build wealth without sacrificing your privacy.',
    twitterImage: domain+basePath+'/images/social-image.png',
    twitterSite: '@serversideup',
    twitterTitle: 'Financial Freedom - An open source alternative to Mint, YNAB, and more.'
})

</script>