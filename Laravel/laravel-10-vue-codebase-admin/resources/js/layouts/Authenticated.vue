<template>
    <h1>Dashboard</h1>
    <button @click="logout">Logout</button>
</template>

<script setup>
import { computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';

import useAuth from '@/composables/auth';

const route = useRoute();
const { getUser, user, processing, logout } = useAuth();
</script>
