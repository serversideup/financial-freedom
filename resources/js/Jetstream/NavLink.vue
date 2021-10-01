<template>
    <Link :href="href" :class="classes">
        <slot></slot>
    </Link>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';

    export default {
        props: ['href', 'active'],

        components: {
            Link
        },

        computed: {
            classes() {
                return this.active
                            ? 'group flex flex-col items-center px-2 py-2 text-xs leading-5 font-normal text-astronaut-900 bg-astronaut-100 hover:text-astronaut-900 hover:bg-astronaut-100 focus:outline-none focus:bg-astronaut-200 transition ease-in-out duration-150'
                            : 'group flex flex-col items-center px-2 py-2 text-xs leading-5 font-normal text-astronaut-600 hover:text-astronaut-900 hover:bg-astronaut-50 focus:outline-none focus:text-astronaut-900 focus:bg-astronaut-50 transition ease-in-out duration-150'
            }
        }
    }
</script>
