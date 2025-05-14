<template>
  <div style="margin-top: 20px;">
    <p v-if="user">Thanks for using Vue, {{ user }}! 🎉</p>
  </div>
</template>

<script>
export default {
  props: {
    user: String
  }
};
</script>
