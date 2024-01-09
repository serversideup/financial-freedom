<template>
    <div class="w-full max-w-7xl mx-auto flex flex-col">
        <div class="flex flex-col px-4 md:px-8 mb-16 pt-24">
            <span class="mb-3 font-sans text-base font-semibold text-[#CECFD2]">Features</span>
            <h2 class="mb-4 md:mb-5 text-[#CECFD2] font-sans text-3xl md:text-4xl font-semibold">Decentralized Financial Budgeting.</h2>
            <span class="text-[#94969C] font-sans text-lg md:text-xl font-normal">It's the way sensitive data should always be handled.</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 mx-4 md:mx-8 gap-16 pb-16 md:pb-24 border-b border-[#1F242F]">
            <div class="flex flex-col space-y-12">
                <div class="flex items-start">
                    <img src="/images/icons/bank.svg" class="mr-4"/>

                    <div class="flex flex-col">
                        <span class="font-sans text-[#CECFD2] font-semibold text-lg md:text-xl mb-2">Compatible with any bank</span>
                        <span class="font-sans text-[#94969C] font-normal text-base">If your bank supports exporting a CSV file, Financial Freedom supports it.</span>
                    </div>
                </div>
                <div class="flex items-start">
                    <img src="/images/icons/zap.svg" class="mr-4"/>

                    <div class="flex flex-col">
                        <span class="font-sans text-[#CECFD2] font-semibold text-lg md:text-xl mb-2">Automated Sync (coming soon)</span>
                        <span class="font-sans text-[#94969C] font-normal text-base">Use API services like Plaid or Finicity for automated account data synchronization. For those who want ultimate privacy, synchronize your account with our decentralized alternative to Plaid & Finicity.</span>
                    </div>
                </div>
                <div class="flex items-start">
                    <img src="/images/icons/server.svg" class="mr-4"/>

                    <div class="flex flex-col">
                        <span class="font-sans text-[#CECFD2] font-semibold text-lg md:text-xl mb-2">Self-host anywhere</span>
                        <span class="font-sans text-[#94969C] font-normal text-base">Financial Freedom is designed to run on any host as long as it can run Docker. Choose from AWS to a Raspberry Pi running in your basement.</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <img src="/images/ui/credit-cards.png"/>
            </div>
        </div>
    </div>
</template>