import axios from 'axios'
import React, { useEffect, useState } from 'react'
import { Link, useNavigate } from 'react-router-dom'

export default function Login() {
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')

  // validation
  const [validation, setValidation] = useState([])

  const navigate = useNavigate()

  useEffect(() => {
    if (localStorage.getItem('token')) {
      navigate('/home')
    }
  }, [navigate])

  const loginHandler = async (e) => {
    e.preventDefault()

    const formData = new FormData()

    formData.append('email', email)
    formData.append('password', password)

    await axios
      .post('http://127.0.0.1:8000/api/auth/login', formData)
      .then((response) => {
        localStorage.setItem('token', response.data.token)

        navigate('/home')
      })
      .catch((error) => {
        setValidation(error.response.data)
      })
  }

  return (
    <div className='container'>
      <div className='d-flex align-items-center' style={{ height: '100vh' }}>
        <div style={{ width: '100%' }}>
          <div className='row justify-content-center'>
            <div className='col-md-6'>
              <div className='card'>
                <div className='card-header'>Login</div>
                <div className='card-body'>
                  {/* Alert */}
                  {validation.error && (
                    <div className='alert alert-danger' role='alert'>
                      <strong>Error!</strong> {validation.error}
                    </div>
                  )}

                  <form action='' onSubmit={loginHandler}>
                    <div className='mb-3'>
                      <label htmlFor='email' className='form-label'>
                        Alamat Email
                      </label>
                      <input
                        type='text'
                        className={`form-control ${
                          validation.email && 'is-invalid'
                        }`}
                        id='email'
                        placeholder='Masukan email. contoh:name@example.com'
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                      />
                      {validation.email && (
                        <small className='invalid-feedback'>
                          {validation.email}
                        </small>
                      )}
                    </div>
                    <div className='mb-3'>
                      <label htmlFor='password' className='form-label'>
                        Kata sandi
                      </label>
                      <input
                        type='password'
                        className={`form-control ${
                          validation.password && 'is-invalid'
                        }`}
                        id='password'
                        placeholder='Masukan kata sandi'
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                      />
                      {validation.password && (
                        <small className='invalid-feedback'>
                          {validation.password}
                        </small>
                      )}
                    </div>
                    <button
                      type='submit'
                      className='btn btn-primary'
                      style={{ marginRight: 5 }}>
                      Login
                    </button>
                    <Link
                      to='/register'
                      className='btn btn-secondary'
                      style={{ marginRight: 5 }}>
                      Register
                    </Link>
                    <Link to='/' className='btn btn-info'>
                      Homepage
                    </Link>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
