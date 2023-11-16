<template>
    <div class="w-full">
        <header class="w-full max-w-7xl mx-auto flex items-center justify-between py-[18px] px-8" :class="{ 'fixed top-[43px]': fixed }">
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
                        <li>
                            Search
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="flex items-center">
                <NuxtLink to="https://github.com/serversideup/financial-freedom" target="_blank" class="flex items-center font-inter text-[#94969C] font-semibold text-base mr-8">
                    <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.40217 2.8778C9.59424 2.48869 9.69028 2.29413 9.82065 2.23197C9.93408 2.17789 10.0659 2.17789 10.1793 2.23197C10.3097 2.29413 10.4057 2.48869 10.5978 2.8778L12.42 6.56944C12.4767 6.68432 12.5051 6.74176 12.5465 6.78635C12.5832 6.82584 12.6272 6.85783 12.6761 6.88056C12.7313 6.90623 12.7946 6.91549 12.9214 6.93402L16.9975 7.5298C17.4267 7.59253 17.6413 7.6239 17.7406 7.72874C17.827 7.81995 17.8677 7.94529 17.8512 8.06985C17.8323 8.21302 17.6769 8.36436 17.3662 8.66702L14.4178 11.5387C14.3259 11.6282 14.28 11.673 14.2503 11.7263C14.2241 11.7734 14.2072 11.8252 14.2007 11.8788C14.1934 11.9393 14.2042 12.0025 14.2259 12.129L14.9216 16.1851C14.995 16.6129 15.0317 16.8269 14.9627 16.9538C14.9027 17.0642 14.7961 17.1417 14.6725 17.1646C14.5305 17.1909 14.3384 17.0899 13.9542 16.8879L10.3103 14.9716C10.1967 14.9119 10.14 14.882 10.0802 14.8703C10.0272 14.8599 9.97274 14.8599 9.91979 14.8703C9.85998 14.882 9.80321 14.9119 9.68967 14.9716L6.04573 16.8879C5.66156 17.0899 5.46947 17.1909 5.32744 17.1646C5.20386 17.1417 5.09723 17.0642 5.03724 16.9538C4.96829 16.8269 5.00498 16.6129 5.07835 16.1851L5.77403 12.129C5.79572 12.0025 5.80656 11.9393 5.79923 11.8788C5.79273 11.8252 5.77589 11.7734 5.74963 11.7263C5.71998 11.673 5.67402 11.6282 5.58211 11.5387L2.63376 8.66702C2.32301 8.36436 2.16764 8.21302 2.14873 8.06985C2.13228 7.94529 2.17292 7.81995 2.25933 7.72874C2.35866 7.6239 2.57327 7.59253 3.0025 7.5298L7.07855 6.93402C7.20531 6.91549 7.26869 6.90623 7.32389 6.88056C7.37276 6.85783 7.41676 6.82584 7.45345 6.78635C7.49488 6.74176 7.52323 6.68432 7.57994 6.56944L9.40217 2.8778Z" stroke="#94969C" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    Star On GitHub
                </NuxtLink>

                <a href="#ff-follow-along" class="py-[10px] px-4 rounded-md border border-[#155EEF] text-white bg-[#155EEF] font-inter text-base font-semibold leading-0">
                    Get Notified
                </a>
            </div>
            <!-- <div class="flex items-center justify-between">
                <NuxtLink :to="'/'">
                    <img class="w-32" src="/images/logos/financial-freedom-white-logo.svg"/>
                </NuxtLink>

                <div class="flex items-center">
                    <AlgoliaDocSearch class="mr-4"/>

                    <div class="flex items-center lg:hidden">
                        <button @click="toggleMobileNav()" class="flex items-center justify-center w-6 h-6 cursor-pointer">
                            <div id="nav-icon" class="w-[18px] h-3 relative" :class="{
                                'open': showMobileMenu
                            }">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </button>
                    </div>
                    <nav class="items-center hidden lg:flex">
                        <div class="flex items-center gap-4 lg:gap-4 xl:gap-8 mr-8">
                            <NuxtLink 
                                :href="'/docs'"
                                class="flex items-center font-inter font-bold text-slate-300 text-sm rounded py-[6px] px-2 hover:bg-gray-900 xl:text-lg">
                                    <div class="flex items-center justify-center w-5 h-5 mr-2">
                                        <svg width="18" height="23" viewBox="0 0 18 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full max-h-full">
                                            <path d="M17 18.4468V15.4468H4C2.34315 15.4468 1 16.79 1 18.4468M5.8 21.4468H13.8C14.9201 21.4468 15.4802 21.4468 15.908 21.2289C16.2843 21.0371 16.5903 20.7311 16.782 20.3548C17 19.927 17 19.3669 17 18.2468V4.64684C17 3.52673 17 2.96668 16.782 2.53886C16.5903 2.16253 16.2843 1.85657 15.908 1.66483C15.4802 1.44684 14.9201 1.44684 13.8 1.44684H5.8C4.11984 1.44684 3.27976 1.44684 2.63803 1.77382C2.07354 2.06144 1.6146 2.52038 1.32698 3.08487C1 3.7266 1 4.56668 1 6.24684V16.6468C1 18.327 1 19.1671 1.32698 19.8088C1.6146 20.3733 2.07354 20.8322 2.63803 21.1199C3.27976 21.4468 4.11984 21.4468 5.8 21.4468Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    
                                    Docs
                            </NuxtLink>  
                            
                            <NuxtLink 
                                :href="'https://serversideup.net/discord'"
                                target="_blank"
                                class="flex items-center font-inter font-bold text-slate-300 text-sm rounded py-[6px] px-2 hover:bg-gray-900 xl:text-lg">
                                    <div class="flex items-center justify-center w-5 h-5 mr-2">
                                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.6361 5.39641C18.1907 4.73466 16.6648 4.26519 15.0973 4C14.8828 4.38343 14.6888 4.77793 14.5159 5.18184C12.8463 4.93025 11.1484 4.93025 9.47881 5.18184C9.30587 4.77797 9.1118 4.38348 8.8974 4C7.32897 4.26743 5.80205 4.73801 4.35518 5.39987C1.48276 9.64967 0.70409 13.7939 1.09342 17.8793C2.77558 19.1222 4.6584 20.0674 6.66003 20.6739C7.11074 20.0677 7.50956 19.4246 7.85226 18.7514C7.20135 18.5083 6.57311 18.2084 5.9748 17.8551C6.13227 17.7409 6.28627 17.6232 6.43508 17.509C8.17601 18.3277 10.0761 18.7522 12 18.7522C13.9238 18.7522 15.8239 18.3277 17.5648 17.509C17.7154 17.6319 17.8694 17.7495 18.0251 17.8551C17.4257 18.209 16.7963 18.5095 16.1442 18.7532C16.4865 19.426 16.8853 20.0686 17.3364 20.6739C19.3398 20.0698 21.224 19.1251 22.9065 17.881C23.3633 13.1433 22.1261 9.03711 19.6361 5.39641ZM8.34541 15.3668C7.26047 15.3668 6.36414 14.3822 6.36414 13.171C6.36414 11.9597 7.22932 10.9665 8.34195 10.9665C9.45458 10.9665 10.344 11.9597 10.325 13.171C10.3059 14.3822 9.45112 15.3668 8.34541 15.3668ZM15.6545 15.3668C14.5678 15.3668 13.675 14.3822 13.675 13.171C13.675 11.9597 14.5401 10.9665 15.6545 10.9665C16.7689 10.9665 17.6514 11.9597 17.6323 13.171C17.6133 14.3822 16.7602 15.3668 15.6545 15.3668Z" fill="#E2E8F0"/>
                                        </svg>
                                    </div>
                                    
                                    Discord
                            </NuxtLink>  

                            <NuxtLink 
                                :href="'https://github.com/serversideup/spin'"
                                target="_blank"
                                class="flex items-center font-inter font-bold text-slate-300 text-sm rounded py-[6px] px-2 hover:bg-gray-900 xl:text-lg">
                                    <div class="flex items-center justify-center w-5 h-5 mr-2">
                                        <svg width="20" height="22" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full max-h-full">
                                            <path d="M7 0.65799C3.1325 0.65799 0 3.79049 0 7.65799C0 10.7555 2.00375 13.3717 4.78625 14.2992C5.13625 14.3605 5.2675 14.1505 5.2675 13.9667C5.2675 13.8005 5.25875 13.2492 5.25875 12.663C3.5 12.9867 3.045 12.2342 2.905 11.8405C2.82625 11.6392 2.485 11.018 2.1875 10.8517C1.9425 10.7205 1.5925 10.3967 2.17875 10.388C2.73 10.3792 3.12375 10.8955 3.255 11.1055C3.885 12.1642 4.89125 11.8667 5.29375 11.683C5.355 11.228 5.53875 10.9217 5.74 10.7467C4.1825 10.5717 2.555 9.96799 2.555 7.29049C2.555 6.52924 2.82625 5.89924 3.2725 5.40924C3.2025 5.23424 2.9575 4.51674 3.3425 3.55424C3.3425 3.55424 3.92875 3.37049 5.2675 4.27174C5.8275 4.11424 6.4225 4.03549 7.0175 4.03549C7.6125 4.03549 8.2075 4.11424 8.7675 4.27174C10.1063 3.36174 10.6925 3.55424 10.6925 3.55424C11.0775 4.51674 10.8325 5.23424 10.7625 5.40924C11.2087 5.89924 11.48 6.52049 11.48 7.29049C11.48 9.97674 9.84375 10.5717 8.28625 10.7467C8.54 10.9655 8.75875 11.3855 8.75875 12.0417C8.75875 12.978 8.75 13.7305 8.75 13.9667C8.75 14.1505 8.88125 14.3692 9.23125 14.2992C10.6209 13.8301 11.8284 12.937 12.6839 11.7457C13.5393 10.5543 13.9996 9.12467 14 7.65799C14 3.79049 10.8675 0.65799 7 0.65799Z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                    
                                    Github
                            </NuxtLink>  

                            <NuxtLink target="_blank" :to="'https://github.com/sponsors/serversideup'" class="flex items-center px-[14px] py-2 font-bold font-inter text-white rounded-lg border border-solid border-slate-700 bg-slate-800 hover:bg-slate-700 text-sm">
                                Sponsor
                                <img class="ml-[10px]" src="/images/icons/heart.svg"/>
                            </NuxtLink>

                            <NuxtLink :to="'/docs'" class="flex items-center px-[14px] py-2 font-bold font-inter text-[#151A1F] rounded-lg bg-[#1CE783] text-sm hover:bg-[#1CE783]">
                                Get Started &rarr;
                            </NuxtLink>
                        </div>
                    </nav>
                </div>
            </div> -->
        </header>

        <!-- <GlobalMobileMenu
            :show="showMobileMenu"
            :navigation="navigation[0]"/> -->
    </div>
</template>

<script setup>
const props = defineProps({ 
    fixed: {
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
</script>