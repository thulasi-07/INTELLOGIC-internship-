<template>
  <div class="box" :class="{ active: isActive }" :style="{ backgroundColor: bgColor }">
    <p>This box changes color and class dynamically.</p>
    <button @click="toggleBox">Toggle Style</button>
  </div>
</template>

<script>
export default {
  name: 'ColorBox',
  data() {
    return {
      isActive: false,
      bgColor: 'lightblue'
    }
  },
  methods: {
    toggleBox() {
      this.isActive = !this.isActive
      this.bgColor = this.isActive ? 'lightgreen' : 'lightblue'
    }
  }
}
</script>

<style scoped>
.box {
  padding: 20px;
  border: 2px solid #ccc;
  margin: 50px auto;
  width: 300px;
  text-align: center;
  transition: 0.3s;
}

.active {
  border-color: green;
  font-weight: bold;
  color: darkgreen;
}
</style>
