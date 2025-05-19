<template>
  <div class="p-4">
    <a-button type="primary" @click="showModal()">Add Application</a-button>

    <a-table :columns="columns" :data-source="applications" row-key="id" class="mt-4">
      <template #bodyCell="{ column, record }">
        <template v-if="column.dataIndex === 'action'">
          <a-button type="link" @click="showModal(record)">Edit</a-button>
          <a-button type="link" danger @click="deleteApplication(record.id)">Delete</a-button>
        </template>
      </template>
    </a-table>

    <a-modal v-model:visible="visible" title="Application Form" @ok="submitForm" @cancel="resetForm">
      <a-form layout="vertical">
        <a-form-item label="Name">
          <a-input v-model:value="form.name" />
        </a-form-item>
        <a-form-item label="Email">
          <a-input v-model:value="form.email" />
        </a-form-item>
        <a-form-item label="Course">
          <a-input v-model:value="form.course" />
        </a-form-item>
      </a-form>
    </a-modal>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ApplicationForm',
  data() {
    return {
      applications: [],
      visible: false,
      form: {
        id: null,
        name: '',
        email: '',
        course: '',
      },
      columns: [
        { title: 'Name', dataIndex: 'name' },
        { title: 'Email', dataIndex: 'email' },
        { title: 'Course', dataIndex: 'course' },
        { title: 'Actions', dataIndex: 'action' },
      ],
    };
  },
  methods: {
    fetchData() {
      axios.get('/api/applications').then(res => {
        this.applications = res.data;
      });
    },
    showModal(record = null) {
      this.visible = true;
      if (record) this.form = { ...record };
    },
    submitForm() {
      const request = this.form.id
        ? axios.put(`/api/applications/${this.form.id}`, this.form)
        : axios.post('/api/applications', this.form);

      request.then(() => {
        this.fetchData();
        this.resetForm();
      });
    },
    deleteApplication(id) {
      axios.delete(`/api/applications/${id}`).then(() => this.fetchData());
    },
    resetForm() {
      this.form = { id: null, name: '', email: '', course: '' };
      this.visible = false;
    },
  },
  mounted() {
    this.fetchData();
  },
};
</script>

<style scoped>
.mt-4 {
  margin-top: 1rem;
}
</style>
