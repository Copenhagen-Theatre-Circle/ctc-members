<template>
  <div>
      <project-basics-edit v-if="edit"></project-basics-edit>
      <project-basics-read v-else></project-basics-read>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        message: 'hello'
      }
    },
    computed: {
      edit(){
        return this.$store.state.edit
      },
    },
    methods: {

    }
  }
</script>
<style scoped></style>
