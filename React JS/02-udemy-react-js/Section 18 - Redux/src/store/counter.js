import { createSlice } from '@reduxjs/toolkit'

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

export default counterSlice.reducer
export const counterActions = counterSlice.actions
