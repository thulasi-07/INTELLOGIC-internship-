<script setup>
import { ref, watch, computed } from 'vue'

const name = ref("")
const email = ref("")
const message = ref("")
const error = ref("")

const reasons = ref([
  "Support",
  "Feedback",
  "Careers",
  "Other"
])

const feedbackText = ref("")
const myClass = ref("")

watch(email, (newVal, oldVal) => {
  if (!newVal.includes('@')) {
    feedbackText.value = 'The e-mail address is NOT valid'
    myClass.value = 'invalid'
  } else if (!oldVal.includes('@') && newVal.includes('@')) {
    feedbackText.value = 'Perfect! You fixed it!'
    myClass.value = 'valid'
  } else {
    feedbackText.value = 'The e-mail address is valid :)'
    myClass.value = 'valid'
  }
})
const opacity = ref(1) 

const immediate = ref(false)
const immediateStatus = computed(() => (immediate.value ? 'Yes' : 'No'))

function handleSubmit() {
  if (!name.value || !email.value || !message.value) {
    error.value = "All fields are required!"
  } else {
    error.value = ""
    alert(Thank you for contacting us, ${name.value}!\nWe will get back to you at ${email.value}.)
    name.value = ""
    email.value = ""
    message.value = ""
    feedbackText.value = ""
    myClass.value = ""
    immediate.value = false
  }
}

</script>

<template>
  <div style="margin-bottom: 1rem; text-align: center;">
    <label for="opacityRange"><strong>Form Opacity:</strong></label><br />
    <input
      id="opacityRange"
      type="range"
      min="0"
      max="1"
      step="0.01"
      v-model="opacity"
    />
    <span style="margin-left: 8px;">{{ opacity }}</span>
  </div>

  
  <div class="outer-box" :style="{ opacity: opacity }">
    <h1 :style="{ fontSize: '2rem', marginBottom: '1rem' }" :title="'Vue Directives in Action'">
      Contact Us
    </h1>

    <form @submit.prevent="handleSubmit" class="form-box">
      <div class="form-group">
        <label>Name:</label>
        <input type="text" v-model="name" placeholder="Enter your name" />
      </div>

      <div class="form-group">
        <label>Email:</label>
        <input type="email" v-model="email" placeholder="Enter your email" />
        <p :class="myClass" class="feedback-message">{{ feedbackText }}</p>
      </div>

      <div class="form-group">
        <label>Reason:</label>
        <select>
          <option v-for="(reason, index) in reasons" :key="index">
            {{ reason }}
          </option>
        </select>
      </div>

      <div class="form-group">
        <label>Message:</label>
        <textarea v-model="message" placeholder="Write your message"></textarea>
      </div>

      <div class="form-group immediate-group">
        <label class="immediate-label">Immediate action</label>
        <input type="checkbox" v-model="immediate" />
        <span class="status">{{ immediateStatus }}</span>
      </div>

      <button type="submit">Submit</button>
    </form>

    <p v-if="error" class="error-msg">{{ error }}</p>
  </div>
  <div class="table-responsive">

  <a-table :columns="column" :row-key="(record) => record.xid" :data-source="table.data" :pagination="table.pagination" :loading="table.loading" @change="handleTableChange">
  <template #bodyCell="{ column,  record }">
  <template v-if="column.dataIndex === 'action'">

  <a-button type="primary" data-bs-toggle="offcanvas" href="#offcanvasRole" role="button" @click="onEdit(record)" style="margin-left: 4px; display: inline-flex; align-items: center; justify-content: center;">
  <template #icon>
  <EditOutlined />
  </template>
  </a-button>
  <a-button type="primary" @click="confirmDelete(record.id)" style="margin-left: 4px; display: inline-flex; align-items: center; justify-content: center;">
  <template #icon>
  <DeleteOutlined />
  </template>
  </a-button>
  </template>
  </template>
  </a-table>
  </div>
</template>

<style scoped>
.outer-box {
  max-width: 800px;
  min-width: 500px;
  width: 80%;
  margin: auto;
  padding: 2rem 3rem;
  border: 2px solid #ccc;
  border-radius: 8px;
  transition: border-color 0.3s ease;
  font-family: sans-serif;


}

.outer-box {
  max-width: 800px;
  min-width: 500px;
  width: 80%;
  margin: auto;
  padding: 2rem 3rem;
  border: 2px solid #ccc;
  border-radius: 8px;
  font-family: sans-serif;

  background-image: url('/img.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;

  background-color: rgba(0, 0, 0, 0.6); 
  background-blend-mode: overlay;
  color: white; 
}

.form-box {
  width: 100%;
  max-width: 700px;
  margin: auto;
  display: flex;
  flex-direction: column;
}

.form-group {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  margin-bottom: 1rem;
}

.form-group:last-child {
  margin-bottom: 0;
}

label {
  font-weight: bold;
  margin-bottom: 0.25rem;
}

input,
textarea,
select {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  align-self: flex-start;
  background-color: #42b883;
  color: white;
  border: none;
  padding: 0.6rem 1.2rem;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #369870;
}

.error-msg {
  color: rgb(170, 33, 33);
  margin-top: 1rem;
}


.feedback-message {
  min-height: 1.2em;
  margin: 0.25rem 0 0 0;
  font-size: 0.9rem;
  line-height: 1.2em;
  visibility: hidden;
  transition: visibility 0.3s ease;
}

.feedback-message.valid,
.feedback-message.invalid {
  visibility: visible;
}

.valid {
  color: rgb(203, 13, 13);
}

.invalid {
  color: rgb(170, 33, 33);
}


.immediate-group {
  display: flex;
  align-items: center;
  gap: 0.6rem;
  flex-direction: row;
}

.immediate-label {
  font-weight: bold;
  margin: 0;
  min-width: 130px;
}

.immediate-group input[type="checkbox"] {
  width: 18px;
  height: 18px;
  margin: 0;
}

.status {
  font-size: 0.9rem;
  font-weight: bold;
  background-color: #88d6e8;
  padding: 0.2rem 0.5rem;
  border-radius: 4px;
  color: #333;
  min-width: 35px;
  text-align: center;
}

</style>