<template>
  <nav>
    <ul class="pagination justify-content-end">
      <li class="page-item" :class="{ disabled: pagination.current_page === 1 }">
        <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">
          Previous
        </a>
      </li>
      <li
        class="page-item"
        v-for="page in pages"
        :key="page"
        :class="{ active: page === pagination.current_page }"
      >
        <a class="page-link" href="#" @click.prevent="changePage(page)">
          {{ page }}
        </a>
      </li>
      <li class="page-item" :class="{ disabled: pagination.current_page === pagination.last_page }">
        <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">
          Next
        </a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: {
    pagination: Object,
    offset: {
      type: Number,
      default: 4
    }
  },
  computed: {
    pages() {
      let pages = [];
      let from = Math.max(1, this.pagination.current_page - this.offset);
      let to = Math.min(this.pagination.last_page, from + this.offset * 2);

      for (let page = from; page <= to; page++) {
        pages.push(page);
      }

      return pages;
    }
  },
  methods: {
    changePage(page) {
      if (page >= 1 && page <= this.pagination.last_page) {
        this.$emit("paginate", page);
      }
    }
  }
};
</script>

<style scoped>
.page-link {
  cursor: pointer;
}
</style>