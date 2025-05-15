<template>
  <div style="padding: 20px; max-width: 400px; margin: auto;">
    <h2>Reactive Data & Computed Properties Demo</h2>

    <label>
      Enter a number:
      <input type="number" v-model.number="number" />
    </label>
    <p>Double the number: {{ doubleNumber }}</p>

    <hr />

    <label>
      First Name:
      <input type="text" v-model="firstName" />
    </label>
    <label>
      Last Name:
      <input type="text" v-model="lastName" />
    </label>
    <p>Your full name: {{ fullName }}</p>
  </div>
</template>

<script>
export default {
  name: 'ComputedExample',
  data() {
    return {
      number: 0,
      firstName: '',
      lastName: ''
    }
  },
  computed: {
    doubleNumber() {
      return this.number * 2
    },
    fullName() {
      return this.firstName + ' ' + this.lastName
    }
  }
}
</script>

<style scoped>
label {
  display: block;
  margin: 10px 0;
}
input {
  margin-left: 10px;
  padding: 4px;
  font-size: 16px;
}
</style>
