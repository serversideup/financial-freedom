<template>
    <Link :href="'/'">
        <img class="w-80 mb-5" src="/img/login_logo.svg"/>
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
