<template>
  <div style="padding: 20px;">
    <h2>Vue Watcher Example</h2>
    <label>
      Enter your age:
      <input type="number" v-model="age" />
    </label>

    <p>{{ message }}</p>
  </div>
</template>

<script>
export default {
  name: 'WatcherExample',
  data() {
    return {
      age: 0,
      message: ''
    }
  },
  watch: {
    age(newVal) {
      if (newVal >= 18) {
        this.message = 'You are an adult.'
      } else if (newVal > 0) {
        this.message = 'You are a minor.'
      } else {
        this.message = ''
      }
    }
  }
}
</script>

<style scoped>
input {
  margin-left: 10px;
  padding: 4px;
}
</style>
