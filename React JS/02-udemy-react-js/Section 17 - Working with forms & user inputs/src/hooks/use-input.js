// import { useState } from 'react'

// const useInput = (validateValue) => {
//   useReducer()
//   const [enteredValue, setEnteredValue] = useState('')
//   const [isTouched, setIsTouched] = useState(false)

//   const valueIsValid = validateValue(enteredValue)
//   const hasError = !valueIsValid && isTouched

//   const valueChangeHandler = (event) => {
//     setEnteredValue(event.target.value)
//   }

//   const inputBlurHandler = (event) => {
//     setIsTouched(true)
//   }

//   const reset = () => {
//     setEnteredValue('')
//     setIsTouched(false)
//   }

//   return {
//     value: enteredValue,
//     isValid: valueIsValid,
//     hasError,
//     valueChangeHandler,
//     inputBlurHandler,
//     reset,
//   }
// }

// export default useInput

import { useReducer } from 'react'

const initialInputState = {
  value: '',
  isTouched: false,
}

const inputStateReducer = (state, action) => {
  switch (action.type) {
    case 'INPUT':
      return { value: action.value, isTouched: state.isTouched }
    case 'BLUR':
      return { isTouched: true, value: state.value }

    case 'RESET':
      return initialInputState

    default:
      break
  }

  return initialInputState
}

const useInput = (validateValue) => {
  const [inputState, dispatch] = useReducer(
    inputStateReducer,
    initialInputState
  )

  const valueIsValid = validateValue(inputState.value)
  const hasError = !valueIsValid && inputState.isTouched

  const valueChangeHandler = (event) => {
    dispatch({ type: 'INPUT', value: event.target.value })
  }

  const inputBlurHandler = (event) => {
    dispatch({ type: 'BLUR' })
  }

  const reset = () => {
    dispatch({ type: 'RESET' })
  }

  return {
    value: inputState.value,
    isValid: valueIsValid,
    hasError,
    valueChangeHandler,
    inputBlurHandler,
    reset,
  }
}

export default useInput
