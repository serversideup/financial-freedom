import tailwindTypography from '@tailwindcss/typography'

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    modules: [
        '@nuxtjs/algolia',
        '@nuxtjs/color-mode',
        '@nuxt/content',
        '@nuxtjs/plausible',
        '@nuxtjs/tailwindcss',
        '@vueuse/nuxt'
    ],

    algolia: {
        apiKey: process.env.ALGOLIA_SEARCH_API_KEY,
        applicationId: process.env.ALGOLIA_APPLICATION_ID,

        docSearch: {
            indexName: process.env.ALGOLIA_INDEX
        }
    },

    content: {
        documentDriven: true,

        markdown: {
            tags: {
                h2: 'AppHeading2',
                h3: 'AppHeading3',
                h4: 'AppHeading4'
            }
        },

        highlight: {
            // OR
            theme: {
              // Default theme (same as single string)
              default: 'github-dark',
              // Theme used if `html.dark`
              dark: 'github-dark',
              // Theme used if `html.sepia`
              sepia: 'monokai'
            }
        }
    },

    colorMode: {
        classSuffix: ''
    },

    nitro: {
        prerender: {
            routes: ['/sitemap.xml']
        }
    },

    plausible: {
        apiHost: 'https://a.521dimensions.com'
    },

    runtimeConfig: {
        public: {
            basePath: process.env.NUXT_APP_BASE_URL,
            domain: process.env.TOP_LEVEL_DOMAIN
        }
    },

    tailwindcss: {
        config: {
            plugins: [tailwindTypography]
        },
        cssPath: '~/assets/css/tailwind.css',
    }
})
