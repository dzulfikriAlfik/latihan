import { useRef, useState } from 'react'
import classes from './CheckOut.module.css'

const isEmpty = (value) => value.trim() === ''
const isFiveChars = (value) => value.trim().length === 5

const CheckOut = (props) => {
  const [formInputsValidity, setFormInputsValidity] = useState({
    name: true,
    street: true,
    postalCode: true,
    city: true,
  })

  const nameInpuRef = useRef()
  const streetInpuRef = useRef()
  const postalCodeInpuRef = useRef()
  const cityInpuRef = useRef()

  const confirmHandler = (event) => {
    event.preventDefault()

    const enteredName = nameInpuRef.current.value
    const enteredStreet = streetInpuRef.current.value
    const enteredPostalCode = postalCodeInpuRef.current.value
    const enteredCity = cityInpuRef.current.value

    const enteredNameIsValid = !isEmpty(enteredName)
    const enteredStreetIsValid = !isEmpty(enteredStreet)
    const enteredCityIsValid = !isEmpty(enteredCity)
    const enteredPostalCodeIsValid = isFiveChars(enteredPostalCode)

    setFormInputsValidity({
      name: enteredNameIsValid,
      street: enteredStreetIsValid,
      city: enteredCityIsValid,
      postalCode: enteredPostalCodeIsValid,
    })

    const formIsValid =
      enteredNameIsValid &&
      enteredStreetIsValid &&
      enteredCityIsValid &&
      enteredPostalCodeIsValid

    // form is valid
    if (!formIsValid) {
      return
    }

    props.onConfirm({
      name: enteredName,
      street: enteredStreet,
      city: enteredCity,
      postalCode: enteredPostalCode,
    })
  }

  const nameControlClasses = `${classes.control} ${
    !formInputsValidity.name ? classes.invalid : ''
  }`

  const streetControlClasses = `${classes.control} ${
    !formInputsValidity.street ? classes.invalid : ''
  }`

  const postalCodeControlClasses = `${classes.control} ${
    !formInputsValidity.postalCode ? classes.invalid : ''
  }`

  const cityControlClasses = `${classes.control} ${
    !formInputsValidity.city ? classes.invalid : ''
  }`

  return (
    <form className={classes.form} onSubmit={confirmHandler}>
      <div className={nameControlClasses}>
        <label htmlFor='name'>Your Name</label>
        <input type='text' id='name' ref={nameInpuRef} />
        {!formInputsValidity.name && <p>Please enter a valid name!</p>}
      </div>
      <div className={streetControlClasses}>
        <label htmlFor='street'>Street</label>
        <input type='text' id='street' ref={streetInpuRef} />
        {!formInputsValidity.street && <p>Please enter a valid street!</p>}
      </div>
      <div className={postalCodeControlClasses}>
        <label htmlFor='postal'>Postal Code</label>
        <input type='text' id='postal' ref={postalCodeInpuRef} />
        {!formInputsValidity.postalCode && (
          <p>Please enter a valid postal code (5 characters long)!</p>
        )}
      </div>
      <div className={cityControlClasses}>
        <label htmlFor='city'>City</label>
        <input type='text' id='city' ref={cityInpuRef} />
        {!formInputsValidity.city && <p>Please enter a valid city!</p>}
      </div>
      <div className={classes.actions}>
        <button type='button' onClick={props.onCancel}>
          Cancel
        </button>
        <button className={classes.submit}>Confirm</button>
      </div>
    </form>
  )
}

export default CheckOut
