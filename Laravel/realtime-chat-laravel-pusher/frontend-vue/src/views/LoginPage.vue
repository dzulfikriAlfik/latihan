<template>
  <div class="container mt-5">
    <h2>Login</h2>
    <form @submit.prevent="handleLogin">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" v-model="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" v-model="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    ...mapActions(['login']),
    async handleLogin() {  // Ganti nama metode login untuk menghindari konflik
      try {
        await this.login({ email: this.email, password: this.password });
        if (this.$store.getters.isAuthenticated) {
          this.$router.push('/dashboard');
        }
      } catch (error) {
        console.error('Login failed', error);
      }
    },
  },
  created() {
    if (this.$store.getters.isAuthenticated) {
      this.$router.push('/dashboard');
    }
  }
};
</script>