<template>
    <div id="ff-follow-along" class="w-full max-w-7xl flex flex-col py-24 px-8">
        <div class="w-full flex flex-col items-center justify-center rounded-2xl bg-[#161B26] p-16">
            <h2 class="font-sans text-4xl text-center text-[#F5F5F6] font-semibold">🚀 We're building in public</h2>
            <div class="mt-5 text-center text-xl font-sans font-normal text-[#94969C]">Follow along and get updates delivered right to your inbox.</div>
            <form action="https://app.convertkit.com/forms/5848145/subscriptions" class="seva-form formkit-form" method="POST" data-sv-form="5848145" data-uid="78a3086587" data-format="inline" data-version="5" data-options='{"settings":{"after_subscribe":{"action":"message","success_message":"Success! Now check your email to confirm your subscription.","redirect_url":""},"analytics":{"google":null,"fathom":null,"facebook":null,"segment":null,"pinterest":null,"sparkloop":null,"googletagmanager":null},"modal":{"trigger":"timer","scroll_percentage":null,"timer":5,"devices":"all","show_once_every":15},"powered_by":{"show":false,"url":"https://convertkit.com/features/forms?utm_campaign=poweredby&amp;utm_content=form&amp;utm_medium=referral&amp;utm_source=dynamic"},"recaptcha":{"enabled":false},"return_visitor":{"action":"show","custom_content":""},"slide_in":{"display_in":"bottom_right","trigger":"timer","scroll_percentage":null,"timer":5,"devices":"all","show_once_every":15},"sticky_bar":{"display_in":"top","trigger":"timer","scroll_percentage":null,"timer":5,"devices":"all","show_once_every":15}},"version":"5"}' min-width="400 500 600 700 800">
                <div data-style="clean">
                    <ul
                        class="formkit-alert formkit-alert-error"
                        data-element="errors"
                        data-group="alert">
                    </ul>
                    <div
                        data-element="fields"
                        data-stacked="false"
                        class="seva-fields formkit-fields flex items-center mt-8">
                            <div class="formkit-field">
                                <input
                                    class="formkit-input mr-4 w-80 text-[#F5F5F6] p-[14px] rounded-lg bg-[#0C111D] border border-[#333741] shadow-sm font-sans text-base outline-none focus:ring-0 focus-visible:ring-0 focus-visible:ring-offset-0 focus:ring-offset-0 placeholder:text-[#85888E] "
                                    name="email_address"
                                    aria-label="Email Address"
                                    placeholder="Email Address"
                                    required=""
                                    type="email"/>
                            </div>
                            <button
                                data-element="submit"
                                class="formkit-submit formkit-submit font-sans text-base font-semibold py-[14px] px-[18px] rounded-lg border border-[#155EEF] bg-[#155EEF] text-white">

                                <span class="">Subscribe</span>
                            </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>

</script>