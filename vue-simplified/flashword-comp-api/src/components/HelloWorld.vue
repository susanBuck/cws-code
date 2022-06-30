<script>

// import { ref } from 'vue'

// defineProps({
//   msg: String
// })

// const count = ref(0)

export default {
  name: "HelloWorld",
  props: ['msg']
}
</script>

<template>
  <h1>{{ msg }}</h1>

  ....
</template>

<style scoped>
a {
  color: #42b983;
}
</style>
