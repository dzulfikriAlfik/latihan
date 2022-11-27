import React, { useEffect, useState } from 'react'
import { Link, useNavigate } from 'react-router-dom'
import axios from 'axios'

export default function Register() {
  const [name, setName] = useState('')
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [passwordConf, setPasswordConf] = useState('')

  // validation
  const [validation, setValidation] = useState([])

  const navigate = useNavigate()

  useEffect(() => {
    if (localStorage.getItem('token')) {
      navigate('/home')
    }
  }, [navigate])

  const registerHandler = async (e) => {
    e.preventDefault()

    const formData = new FormData()

    formData.append('name', name)
    formData.append('email', email)
    formData.append('password', password)
    formData.append('password_confirmation', passwordConf)

    await axios
      .post('http://127.0.0.1:8000/api/auth/register', formData)
      .then(() => {
        navigate('/login')
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
                <div className='card-header'>Register</div>
                <div className='card-body'>
                  <form action='' onSubmit={registerHandler}>
                    <div className='mb-3'>
                      <label htmlFor='name' className='form-label'>
                        Nama Lengkap
                      </label>
                      <input
                        type='text'
                        className={`form-control ${
                          validation.name && 'is-invalid'
                        }`}
                        id='name'
                        placeholder='Masukan nama lengkap'
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                      />
                      {validation.name && (
                        <small className='invalid-feedback'>
                          {validation.name}
                        </small>
                      )}
                    </div>
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
                    <div className='mb-3'>
                      <label
                        htmlFor='password_confirmation'
                        className='form-label'>
                        Ulangi kata sandi
                      </label>
                      <input
                        type='password'
                        className='form-control'
                        id='password_confirmation'
                        placeholder='Ulangi kata sandi'
                        value={passwordConf}
                        onChange={(e) => setPasswordConf(e.target.value)}
                      />
                    </div>
                    <button
                      type='submit'
                      className='btn btn-primary'
                      style={{ marginRight: 5 }}>
                      Register
                    </button>
                    <Link
                      to='/login'
                      className='btn btn-secondary'
                      style={{ marginRight: 5 }}>
                      Login
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
