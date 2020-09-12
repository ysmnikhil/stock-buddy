<template>
  <vs-select
    label="Condition"
    v-model="condition"
    v-on:change="emit($event)"
  >
    <vs-option label="Is Equal" value="equal">
      Is Equal
    </vs-option>
    <vs-option label="Not Equal" value="notEqual">
      Not Equal
    </vs-option>
    <vs-option label="Like" value="like">
      Like
    </vs-option>
    <vs-option label="Greater" value="greater">
      Greater
    </vs-option>
    <vs-option label="Less" value="less">
      Less
    </vs-option>
  </vs-select>
</template>
<script>
export default {
  props: {
    condition: {
      type: String,
      default: '',
    }
  },
  methods: {
    emit(event) {
      this.$emit('select', event);
    }
  }
}
</script>

