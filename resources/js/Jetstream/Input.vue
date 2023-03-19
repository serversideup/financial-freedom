<template>
  <input
    ref="input"
    class="form-input rounded-md shadow-sm"
    :value="value"
    @input="$emit('input', $event.target.value)"
  />
</template>

<script>
export default {
  props: ['value'],

  methods: {
    focus() {
      this.$refs.input.focus();
    },
  },
};
</script>
