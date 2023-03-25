import React, { useState } from 'react'

import Button from '../UI/Button'
import Card from '../UI/Card'
import ErrorModal from '../UI/ErrorModal'

//** Styles
import styles from './AddUser.module.css'

export default function AddUser({ onAddUser }) {
  const [enteredUsername, setEnteredUsername] = useState('')
  const [enteredAge, setEnteredAge] = useState(0)
  const [error, setError] = useState()

  const usernameChangeHandler = (event) => {
    setEnteredUsername(event.target.value)
  }

  const ageChangeHandler = (event) => {
    setEnteredAge(event.target.value)
  }

  const addUserHandler = (event) => {
    event.preventDefault()

    if (enteredUsername.trim().length === 0 || enteredAge.trim().length === 0) {
      setError({
        title: 'Invalid input',
        message: 'Username / Age should not be blank',
      })

      return
    }

    if (+enteredAge < 1) {
      setError({
        title: 'Invalid input',
        message: 'Age should not be less than 1',
      })
      return
    }

    onAddUser(enteredUsername, enteredAge)

    setEnteredUsername('')
    setEnteredAge('')
  }

  const errorHandler = () => {
    setError(null)
  }

  return (
    <>
      {error && (
        <ErrorModal
          title={error.title}
          message={error.message}
          onConfirm={errorHandler}
        />
      )}
      <Card className={styles.input}>
        <form onSubmit={addUserHandler}>
          <label htmlFor='username'>Username</label>
          <input
            type='text'
            id='username'
            value={enteredUsername}
            onChange={usernameChangeHandler}
          />
          <label htmlFor='age'>Age (Years)</label>
          <input
            type='number'
            id='age'
            value={enteredAge}
            onChange={ageChangeHandler}
          />
          <Button type='submit'>Add User</Button>
        </form>
      </Card>
    </>
  )
}
