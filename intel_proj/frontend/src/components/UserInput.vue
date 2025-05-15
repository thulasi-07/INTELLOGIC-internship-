<template>
  <div class="input-container">
    <h2>Welcome, {{ username }}!</h2>
    <input 
      type="text" 
      v-model="username" 
      placeholder="Enter your name" 
      class="input-box"
    />
  </div>
</template>

<script>
export default {
  name: 'UserInput',
  data() {
    return {
      username: ''
    }
  }
}
</script>

<style scoped>
.input-container {
  text-align: center;
  margin-top: 50px;
}

.input-box {
  padding: 10px;
  font-size: 16px;
  border: 1px solid #aaa;
  border-radius: 5px;
  margin-top: 10px;
}
</style>
