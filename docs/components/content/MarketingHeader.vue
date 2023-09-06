<template>
    <div class="w-full">
    <header class="w-full py-4 px-6 backdrop-blur z-50 lg:px-8" :class="{ 'fixed top-[43px]': fixed }">
        <div class="flex items-center justify-between">
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
        </div>
    </header>

    <GlobalMobileMenu
        :show="showMobileMenu"
        :navigation="navigation[0]"/>
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