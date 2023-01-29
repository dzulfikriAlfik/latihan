import { useState } from 'react'
import validator from 'validator'
import Select from 'react-select'

const countryOptions = [
  { value: 'asgard', label: 'Asgard' },
  { value: 'indonesia', label: 'Indonesia' },
  { value: 'usa', label: 'USA' },
]

export default function UserForm({ onSave, user = {} }) {
  const [userData, setUserData] = useState(user)
  const [errors, setErrors] = useState({})

  const { name, email, website, country } = userData

  const validateData = () => {
    let errors = {}

    if (!name) {
      errors.name = 'Name is required'
    }

    if (!validator.isEmail(email)) {
      errors.email = 'A valid email is required'
    }

    if (!validator.isURL(website)) {
      errors.website = 'A valid website is required'
    }

    if (!country) {
      errors.country = 'A country is required'
    }

    return errors
  }

  const handleChange = (event) => {
    const { name, value } = event.target

    delete errors[name]

    setUserData((prevData) => ({ ...prevData, [name]: value }))
  }

  const handleSelectChange = (option) => {
    setUserData((prevData) => ({ ...prevData, country: option }))
  }

  const handleSave = () => {
    const errors = validateData()

    if (Object.keys(errors).length) {
      setErrors(errors)
      return
    }

    setErrors({})
    console.log('save User Data : ', userData)
    onSave(userData)
  }

  return (
    <>
      <div>
        <p>Name</p>
        <input type='text' name='name' value={name} onChange={handleChange} />
        <div style={{ color: 'red' }}>{errors.name}</div>
      </div>
      {/* Separator */}
      <hr />
      {/* Separator */}
      <div>
        <p>Email</p>
        <input type='text' name='email' value={email} onChange={handleChange} />
        <div style={{ color: 'red' }}>{errors.email}</div>
      </div>
      {/* Separator */}
      <hr />
      {/* Separator */}
      <div>
        <p>Website</p>
        <input
          type='text'
          name='website'
          value={website}
          onChange={handleChange}
        />
        <div style={{ color: 'red' }}>{errors.website}</div>
      </div>
      {/* Separator */}
      <hr />
      {/* Separator */}
      <div>
        <p>Country</p>
        <Select
          value={countryOptions.find(({ value }) => value === country)}
          onChange={handleSelectChange}
          options={countryOptions}
        />
      </div>
      {/* Separator */}
      <hr />
      {/* Separator */}
      <div style={{ marginTop: '12px' }}>
        <button onClick={handleSave}>Save</button>
      </div>
    </>
  )
}
