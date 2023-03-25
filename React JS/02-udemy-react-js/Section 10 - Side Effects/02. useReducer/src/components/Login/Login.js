import React, { useEffect, useReducer, useState } from 'react'

import Card from '../UI/Card/Card'
import classes from './Login.module.css'
import Button from '../UI/Button/Button'

const defaultInputValue = {
  email: {
    value: '',
    isValid: false,
  },
  password: {
    value: '',
    isValid: false,
  },
}

const inputReducer = (state, { type, id, val }) => {
  if (type === 'USER_INPUT') {
    return {
      ...state,
      [id]: {
        value: val,
        isValid: id === 'email' ? val.includes('@') : val.trim().length > 6,
      },

      // isValidForm:
      //   id === 'email'
      //     ? val.includes('@') && state.password.isValid
      //     : val.trim().length > 6 && state.email.isValid,
    }
  }

  if (type === 'INPUT_BLUR') {
    return state
  }

  return defaultInputValue
}

const Login = (props) => {
  const [inputState, dispatchInput] = useReducer(
    inputReducer,
    defaultInputValue
  )

  const [formIsValid, setFormIsValid] = useState(false)

  // useEffect(() => {
  //   console.log('EFFECT RUNNING')

  //   return () => {
  //     console.log('EFFECT CLEANUP')
  //   }
  // }, [])

  const { isValid: emailIsValid } = inputState.email
  const { isValid: passwordIsValid } = inputState.password

  useEffect(() => {
    const identifier = setTimeout(() => {
      console.log('Checking form validity!')
      setFormIsValid(emailIsValid && passwordIsValid)
    }, 500)

    return () => {
      console.log('CLEANUP')
      clearTimeout(identifier)
    }
  }, [emailIsValid, passwordIsValid])

  const inputChangeHandler = (event) => {
    dispatchInput({
      type: 'USER_INPUT',
      id: event.target.id,
      val: event.target.value,
    })
  }

  const validateInputHandler = () => {
    dispatchInput({ type: 'INPUT_BLUR' })
  }

  const submitHandler = (event) => {
    event.preventDefault()
    props.onLogin(inputState.email.value, inputState.password.value)
  }

  return (
    <Card className={classes.login}>
      <form onSubmit={submitHandler}>
        <div
          className={`${classes.control} ${
            inputState.email.isValid === false ? classes.invalid : ''
          }`}>
          <label htmlFor='email'>E-Mail</label>
          <input
            type='email'
            id='email'
            value={inputState.email.value}
            onChange={inputChangeHandler}
            onBlur={validateInputHandler}
          />
        </div>
        <div
          className={`${classes.control} ${
            inputState.password.isValid === false ? classes.invalid : ''
          }`}>
          <label htmlFor='password'>Password</label>
          <input
            type='password'
            id='password'
            value={inputState.password.value}
            onChange={inputChangeHandler}
            onBlur={validateInputHandler}
          />
        </div>
        <div className={classes.actions}>
          <Button type='submit' className={classes.btn} disabled={!formIsValid}>
            Login
          </Button>
        </div>
      </form>
    </Card>
  )
}

export default Login
