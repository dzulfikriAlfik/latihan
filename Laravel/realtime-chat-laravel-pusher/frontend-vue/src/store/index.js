import { createStore } from 'vuex'
import axios from 'axios'

const store = createStore({
  state: {
    user: JSON.parse(localStorage.getItem('user')) || null,
  },
  mutations: {
    setUser(state, user) {
      state.user = user
      localStorage.setItem('user', JSON.stringify(user))
    },
    clearUser(state) {
      state.user = null
      localStorage.removeItem('user')
    },
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        const response = await axios.post(
          'http://127.0.0.1:8000/api/auth/login',
          credentials
        )
        commit('setUser', response.data.user)
      } catch (error) {
        console.error('Login failed', error)
        throw error // Tambahkan ini untuk menangani error di komponen
      }
    },
    logout({ commit }) {
      commit('clearUser')
    },
  },
  getters: {
    isAuthenticated: (state) => !!state.user,
  },
})

export default store
