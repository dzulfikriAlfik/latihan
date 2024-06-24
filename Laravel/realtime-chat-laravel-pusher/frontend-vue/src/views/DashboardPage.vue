<template>
  <div class="container mt-5">
    <h2>Dashboard</h2>
    <p>This is the dashboard, accessible only to logged-in users.</p>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'DashboardPage',
  computed: {
    ...mapGetters(['isAuthenticated']),
  },
  created() {
    this.checkAuth();
  },
  methods: {
    checkAuth() {
      if (!this.isAuthenticated) {
        this.$router.push('/login');
      }
    },
  },
};
</script>