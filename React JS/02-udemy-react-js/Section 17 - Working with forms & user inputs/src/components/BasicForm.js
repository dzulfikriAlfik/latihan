import useInput from '../hooks/use-input'

const isEmpty = (value) => value.trim() !== ''
const isEmail = (value) =>
  value.trim() !== '' &&
  value.match(/^\w+([\\.-]?\w+)*@\w+([\\.-]?\w+)*(\.\w{2,3})+$/)

const BasicForm = (props) => {
  const {
    value: firstNameValue,
    isValid: firstNameIsValid,
    hasError: firstNameHasError,
    inputBlurHandler: firstNameBlurHandler,
    valueChangeHandler: firstNameChangeHandler,
    reset: resetFirstNameInput,
  } = useInput(isEmpty)

  const {
    value: lastNameValue,
    isValid: lastNameIsValid,
    hasError: lastNameHasError,
    inputBlurHandler: lastNameBlurHandler,
    valueChangeHandler: lastNameChangeHandler,
    reset: resetLastNameInput,
  } = useInput(isEmpty)

  const {
    value: emailValue,
    isValid: emailIsValid,
    hasError: emailHasError,
    inputBlurHandler: emailBlurHandler,
    valueChangeHandler: emailChangeHandler,
    reset: resetEmailInput,
  } = useInput(isEmail)

  let formIsValid = false

  if (firstNameIsValid && lastNameIsValid && emailIsValid) {
    formIsValid = true
  }

  const formSubmissionHandler = (event) => {
    event.preventDefault()

    if (!formIsValid) return

    console.log('firstNameValue: ', firstNameValue)
    console.log('lastNameValue: ', lastNameValue)
    console.log('emailValue: ', emailValue)

    resetFirstNameInput()
    resetLastNameInput()
    resetEmailInput()
  }

  const firstNameInputClasses = firstNameHasError
    ? 'form-control invalid'
    : 'form-control'

  const lastNameInputClasses = lastNameHasError
    ? 'form-control invalid'
    : 'form-control'

  const emailInputClasses = emailHasError
    ? 'form-control invalid'
    : 'form-control'

  return (
    <form onSubmit={formSubmissionHandler}>
      <div className='control-group'>
        <div className={firstNameInputClasses}>
          <label htmlFor='name'>First Name</label>
          <input
            type='text'
            id='name'
            onBlur={firstNameBlurHandler}
            onChange={firstNameChangeHandler}
            value={firstNameValue}
          />
          {firstNameHasError && (
            <p className='error-text'>First Name must not be empty.</p>
          )}
        </div>
        <div className={lastNameInputClasses}>
          <label htmlFor='name'>Last Name</label>
          <input
            type='text'
            id='name'
            onBlur={lastNameBlurHandler}
            onChange={lastNameChangeHandler}
            value={lastNameValue}
          />
          {lastNameHasError && (
            <p className='error-text'>Last Name must not be empty.</p>
          )}
        </div>
      </div>
      <div className={emailInputClasses}>
        <label htmlFor='name'>E-Mail Address</label>
        <input
          type='text'
          id='name'
          onBlur={emailBlurHandler}
          onChange={emailChangeHandler}
          value={emailValue}
        />
        {emailHasError && (
          <p className='error-text'>
            Email must not be empty & Email should be a valid email address.
          </p>
        )}
      </div>
      <div className='form-actions'>
        <button disabled={!formIsValid}>Submit</button>
      </div>
    </form>
  )
}

export default BasicForm
