<template>
    <div>
        <Link :href="href" :class="classes">
            <slot></slot>
        </Link>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';

    export default {
        props: ['active', 'href', 'as'],

        components: {
            Link
        },

        computed: {
            classes() {
                return this.active
                            ? 'group flex items-center px-2 py-2 text-base leading-6 font-medium text-astronaut-900 bg-astronaut-100 focus:outline-none focus:bg-astronaut-200 transition ease-in-out duration-150'
                            : 'group flex items-center px-2 py-2 text-base leading-6 font-medium text-astronaut-600 hover:text-astronaut-900 hover:bg-astronaut-50 focus:outline-none focus:text-astronaut-900 focus:bg-astronaut-100 transition ease-in-out duration-150'
            }
        }
    }
</script>
