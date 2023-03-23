import { createSlice } from '@reduxjs/toolkit'

const uiSlice = createSlice({
  name: 'ui',
  initialState: { cartIsVisible: false, notification: null },
  reducers: {
    toggle(state) {
      state.cartIsVisible = !state.cartIsVisible
    },
    showNotification(state, action) {
      state.notification = {
        status: action.payload.staus,
        title: action.payload.title,
        message: action.payload.message,
      }
    },
  },
})

export default uiSlice.reducer
export const uiActions = uiSlice.actions
