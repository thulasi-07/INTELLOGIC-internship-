<template>
  <main>
    <div>
      <!-- Table -->
      <table id="application-tblwrapper" class="table mb-0">
        <thead>
          <tr>
            <th @click="sortingArr('name')">Name</th>
            <th @click="sortingArr('email')">Email</th>
            <th @click="sortingArr('course')">Course</th>
            <th @click="sortingArr('id')">ID</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in applicationData.data" :key="item.id">
            <td>{{ item.name }}</td>
            <td>{{ item.email }}</td>
            <td>{{ item.course }}</td>
            <td>{{ item.id }}</td>
            <td>
              <button class="btn btn-primary btn-sm" @click="onEdit(item)" data-bs-toggle="modal" data-bs-target="#applicationModal">
                Edit
              </button>
              <button class="btn btn-danger btn-sm" @click="confirmDelete(item.id)">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Pagination Info -->
      <div class="row px-3">
        <div class="col-md-6">
          Showing {{ applicationData.from || 0 }} to {{ applicationData.to || 0 }} of {{ applicationData.total || 0 }} entries
        </div>
        <div class="col-md-6 text-end">
          <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#applicationModal" @click="resetForm">
            + Add Application
          </button>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="applicationModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form @submit.prevent="submitForm">
          <div class="modal-content p-3">
            <div class="modal-header">
              <h5 class="modal-title">{{ form.id ? 'Edit' : 'Add' }} Application</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" />
            </div>
            <div class="modal-body">
              <div class="mb-2">
                <label>Name</label>
                <input type="text" class="form-control" v-model="form.name" required />
              </div>
              <div class="mb-2">
                <label>Email</label>
                <input type="email" class="form-control" v-model="form.email" required />
              </div>
              <div class="mb-2">
                <label>Course</label>
                <input type="text" class="form-control" v-model="form.course" required />
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Save</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      applicationData: {
        data: [],
        total: 0,
        per_page: 10,
        last_page: 1,
        from: 0,
        to: 0,
        current_page: 1,
      },
      sortKey: '',
      sortOrder: 'asc',
      form: {
        id: null,
        name: '',
        email: '',
        course: '',
      },
    };
  },
  methods: {
    async fetchApplications() {
      try {
        const response = await this.$axios.get(
          `/applications?page=${this.applicationData.current_page}&sortKey=${this.sortKey}&sortOrder=${this.sortOrder}`
        );
        if (response.data && response.data.applications) {
          this.applicationData = response.data.applications;
        }
      } catch (error) {
        console.error('Error fetching applications:', error);
      }
    },
    onChangePage(page) {
      this.applicationData.current_page = page;
      this.fetchApplications();
    },
    sortingArr(column) {
      if (this.sortKey === column) {
        this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
      } else {
        this.sortKey = column;
        this.sortOrder = 'asc';
      }
      this.fetchApplications();
    },
    onEdit(item) {
      this.form = { ...item };
    },
    async submitForm() {
      try {
        if (this.form.id) {
          await this.$axios.put(`/applications/${this.form.id}`, this.form);
        } else {
          await this.$axios.post('/applications', this.form);
        }
        this.fetchApplications();
        this.resetForm();
        const modal = bootstrap.Modal.getInstance(document.getElementById('applicationModal'));
        modal.hide();
      } catch (error) {
        console.error('Error saving application:', error);
      }
    },
    async confirmDelete(id) {
      if (confirm('Are you sure you want to delete this application?')) {
        try {
          await this.$axios.delete(`/applications/${id}`);
          this.fetchApplications();
        } catch (error) {
          console.error('Error deleting application:', error);
        }
      }
    },
    resetForm() {
      this.form = {
        id: null,
        name: '',
        email: '',
        course: '',
      };
    },
  },
  mounted() {
    this.fetchApplications();
  },
};
</script>

<style scoped>
.table th {
  cursor: pointer;
}
</style>
