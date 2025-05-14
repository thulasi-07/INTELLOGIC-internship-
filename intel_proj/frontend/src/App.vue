<template>
  <div style="padding: 20px;">
    <h1>Hello, Vue Beginner </h1>

    <input v-model="name" placeholder="Enter your name" />
    <p>Welcome, {{ name || 'Guest' }}!</p>

    <h2>My Favorite Fruits </h2>
    <ul>
      <li v-for="(fruit, index) in fruits" :key="index">{{ fruit }}</li>
    </ul>

    <HelloUser :user="name" />
  </div>
</template>

<script>
import HelloUser from './components/HelloUser.vue';

export default {
  name: 'App',
  components: {
    HelloUser
  },
  data() {
    return {
      name: '',
      fruits: ['Apple', 'Banana', 'Mango']
    };
  }
};
</script>
