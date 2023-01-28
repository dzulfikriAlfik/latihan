import { createSlice, configureStore } from '@reduxjs/toolkit'

const initialCounterState = {
  value: 0,
  showCounter: true,
}

const counterSlice = createSlice({
  name: 'counter',
  initialState: initialCounterState,
  reducers: {
    increment(state, action) {
      state.value = state.value + action.payload
    },
    decrement(state) {
      state.value--
    },
    toggle(state) {
      state.showCounter = !state.showCounter
    },
    reset(state) {
      state.value = 0
    },
  },
})

const initialAuthState = {
  isAuthenticated: localStorage.getItem('isLoggedIn') === 'true' ? true : false,
}

const authSlice = createSlice({
  name: 'authentication',
  initialState: initialAuthState,
  reducers: {
    login(state) {
      localStorage.setItem('isLoggedIn', true)

      state.isAuthenticated = true
    },
    logout(state) {
      localStorage.setItem('isLoggedIn', false)
      localStorage.removeItem('isLoggedIn')

      state.isAuthenticated = false
    },
  },
})

const store = configureStore({
  reducer: {
    counter: counterSlice.reducer,
    auth: authSlice.reducer,
  },
})

export const counterActions = counterSlice.actions
export const authActions = authSlice.actions

export default store
