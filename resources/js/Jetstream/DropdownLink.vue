<template>
  <div>
    <Link
      :href="href"
      class="block px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
    >
      <slot></slot>
    </Link>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  components: {
    Link,
  },
  props: ['href', 'as'],
};
</script>
