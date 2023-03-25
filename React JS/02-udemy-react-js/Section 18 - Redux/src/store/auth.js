import { createSlice } from '@reduxjs/toolkit'

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
      localStorage.removeItem('isLoggedIn')

      state.isAuthenticated = false
    },
  },
})

export default authSlice.reducer
export const authActions = authSlice.actions
