import { createStore } from 'redux'
import { createSlice } from '@reduxjs/toolkit'

const defaultState = {
  counter: 0,
  showCounter: true,
}

createSlice({
  name: 'counter',
  initialState: defaultState,
  reducers: {
    increment(state) {
      state.counter++
    },
    decrement() {},
    toggle() {},
  },
})

export const INCREMENT = 'increment'

const counterReducer = (state = defaultState, action) => {
  if (action.type === INCREMENT) {
    return {
      counter: state.counter + action.value,
      showCounter: state.showCounter,
    }
  }

  if (action.type === 'decrement') {
    return {
      counter: state.counter - 1,
      showCounter: state.showCounter,
    }
  }

  if (action.type === 'toggle') {
    return {
      showCounter: !state.showCounter,
      counter: state.counter,
    }
  }

  return state
}

const store = createStore(counterReducer)

export default store
