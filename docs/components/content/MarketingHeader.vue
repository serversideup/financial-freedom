<template>
    <div class="w-full">
        <header class="w-full" :class="{ 'fixed top-[43px]': fixed, 'backdrop-blur': bgOpacity, 'bg-[#0C111D]': showMobileMenu }">
            <div class="w-full mx-auto flex items-center justify-between py-[18px] px-8">
                <div class="flex items-center">
                    <NuxtLink :to="'/'" class="mr-10">
                        <img class="h-8" src="/images/logos/financial-freedom-white-logo.svg"/>
                    </NuxtLink>

                    <nav class="hidden items-center lg:flex">
                        <ul class="flex items-center gap-x-8">
                            <li>
                                <NuxtLink :to="'/'" class="font-inter text-[#94969C] font-semibold text-base">
                                    Home
                                </NuxtLink>
                            </li>
                            <li>
                                <NuxtLink :to="'/docs'" class="font-inter text-[#94969C] font-semibold text-base">
                                    Docs
                                </NuxtLink>
                            </li>
                            <li>
                                <NuxtLink :to="'/blog'" class="font-inter text-[#94969C] font-semibold text-base">
                                    Blog
                                </NuxtLink>
                            </li>
                            <li>
                                <NuxtLink to="https://serversideup.net/discord" target="_blank" class="font-inter text-[#94969C] font-semibold text-base">
                                    Discord
                                </NuxtLink>
                            </li>
                            <li>
                                <NuxtLink to="https://github.com/serversideup/financial-freedom" target="_blank" class="flex items-center font-inter text-[#94969C] font-semibold text-base">
                                    <svg class="mr-1" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.7335 1.25C5.89915 1.25 1.98352 5.16562 1.98352 10C1.98352 13.8719 4.48821 17.1422 7.96633 18.3016C8.40383 18.3781 8.5679 18.1156 8.5679 17.8859C8.5679 17.6781 8.55696 16.9891 8.55696 16.2563C6.35852 16.6609 5.78977 15.7203 5.61477 15.2281C5.51633 14.9766 5.08977 14.2 4.7179 13.9922C4.41165 13.8281 3.97415 13.4234 4.70696 13.4125C5.39602 13.4016 5.88821 14.0469 6.05227 14.3094C6.83977 15.6328 8.09758 15.2609 8.60071 15.0312C8.67727 14.4625 8.90696 14.0797 9.15852 13.8609C7.21165 13.6422 5.17727 12.8875 5.17727 9.54062C5.17727 8.58906 5.51633 7.80156 6.07415 7.18906C5.98665 6.97031 5.6804 6.07344 6.16165 4.87031C6.16165 4.87031 6.89446 4.64063 8.5679 5.76719C9.2679 5.57031 10.0116 5.47187 10.7554 5.47187C11.4991 5.47187 12.2429 5.57031 12.9429 5.76719C14.6163 4.62969 15.3491 4.87031 15.3491 4.87031C15.8304 6.07344 15.5241 6.97031 15.4366 7.18906C15.9945 7.80156 16.3335 8.57812 16.3335 9.54062C16.3335 12.8984 14.2882 13.6422 12.3413 13.8609C12.6585 14.1344 12.932 14.6594 12.932 15.4797C12.932 16.65 12.921 17.5906 12.921 17.8859C12.921 18.1156 13.0851 18.3891 13.5226 18.3016C15.2596 17.7152 16.769 16.5988 17.8383 15.1096C18.9077 13.6204 19.4831 11.8333 19.4835 10C19.4835 5.16562 15.5679 1.25 10.7335 1.25Z" fill="#94969C"/>
                                    </svg>

                                    GitHub
                                </NuxtLink>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="items-center hidden lg:flex">
                    <NuxtLink to="https://github.com/serversideup/financial-freedom" target="_blank" class="flex items-center font-inter text-[#94969C] font-semibold text-base mr-8">
                        <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.40217 2.8778C9.59424 2.48869 9.69028 2.29413 9.82065 2.23197C9.93408 2.17789 10.0659 2.17789 10.1793 2.23197C10.3097 2.29413 10.4057 2.48869 10.5978 2.8778L12.42 6.56944C12.4767 6.68432 12.5051 6.74176 12.5465 6.78635C12.5832 6.82584 12.6272 6.85783 12.6761 6.88056C12.7313 6.90623 12.7946 6.91549 12.9214 6.93402L16.9975 7.5298C17.4267 7.59253 17.6413 7.6239 17.7406 7.72874C17.827 7.81995 17.8677 7.94529 17.8512 8.06985C17.8323 8.21302 17.6769 8.36436 17.3662 8.66702L14.4178 11.5387C14.3259 11.6282 14.28 11.673 14.2503 11.7263C14.2241 11.7734 14.2072 11.8252 14.2007 11.8788C14.1934 11.9393 14.2042 12.0025 14.2259 12.129L14.9216 16.1851C14.995 16.6129 15.0317 16.8269 14.9627 16.9538C14.9027 17.0642 14.7961 17.1417 14.6725 17.1646C14.5305 17.1909 14.3384 17.0899 13.9542 16.8879L10.3103 14.9716C10.1967 14.9119 10.14 14.882 10.0802 14.8703C10.0272 14.8599 9.97274 14.8599 9.91979 14.8703C9.85998 14.882 9.80321 14.9119 9.68967 14.9716L6.04573 16.8879C5.66156 17.0899 5.46947 17.1909 5.32744 17.1646C5.20386 17.1417 5.09723 17.0642 5.03724 16.9538C4.96829 16.8269 5.00498 16.6129 5.07835 16.1851L5.77403 12.129C5.79572 12.0025 5.80656 11.9393 5.79923 11.8788C5.79273 11.8252 5.77589 11.7734 5.74963 11.7263C5.71998 11.673 5.67402 11.6282 5.58211 11.5387L2.63376 8.66702C2.32301 8.36436 2.16764 8.21302 2.14873 8.06985C2.13228 7.94529 2.17292 7.81995 2.25933 7.72874C2.35866 7.6239 2.57327 7.59253 3.0025 7.5298L7.07855 6.93402C7.20531 6.91549 7.26869 6.90623 7.32389 6.88056C7.37276 6.85783 7.41676 6.82584 7.45345 6.78635C7.49488 6.74176 7.52323 6.68432 7.57994 6.56944L9.40217 2.8778Z" stroke="#94969C" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        Star On GitHub
                    </NuxtLink>

                    <NuxtLink v-if="docs" to="/#ff-follow-along" class="py-[10px] px-4 rounded-md border border-[#155EEF] text-white bg-[#155EEF] font-inter text-base font-semibold leading-0">
                        Get Notified
                    </NuxtLink>

                    <a v-if="!docs" href="#ff-follow-along" class="py-[10px] px-4 rounded-md border border-[#155EEF] text-white bg-[#155EEF] font-inter text-base font-semibold leading-0">
                        Get Notified
                    </a>
                </div>

                <button class="p-2 flex items-center justify-center lg:hidden" @click="toggleMobileNav()">
                    <svg v-show="!showMobileMenu" width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 7H19M1 1H19M1 13H19" stroke="#CECFD2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg v-show="showMobileMenu" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 1L1 13M1 1L13 13" stroke="#CECFD2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </button>
            </div>
        </header>

        <GlobalMobileMenu
            :show="showMobileMenu"
            :navigation="navigation[0]"
            @close-mobile-menu="showMobileMenu = false"/>
    </div>
</template>

<script setup>
import { onMounted } from '#imports';

const props = defineProps({ 
    fixed: {
        default: false
    },

    docs: {
        default: false
    }
});

const showMobileMenu = ref(false);
const toggleMobileNav = () => {
    showMobileMenu.value = showMobileMenu.value ? false : true;
}
watch(showMobileMenu, ( newValue ) => {
    if( newValue ){
        document.documentElement.classList.add('overflow-y-hidden');
        document.body.classList.add('overflow-y-hidden');
    }else{
        document.documentElement.classList.remove('overflow-y-hidden');
        document.body.classList.remove('overflow-y-hidden');
    }
});

const { navigation } = useContent();

const bgOpacity = ref(false);
onMounted(() => {
    window.onscroll = () => {
        if( window.scrollY > 10 ){
            bgOpacity.value = true;
        }else{
            bgOpacity.value = false;
        }
    }
});
</script>