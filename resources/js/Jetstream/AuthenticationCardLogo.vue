<template>
  <Link :href="'/'">
    <img class="mb-5 w-80" src="/img/login_logo.svg" />
  </Link>
</template>

<script>
import { defineComponent } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
  components: {
    Link,
  },
});
</script>
