import axios from 'axios'
import React, { useEffect, useState } from 'react'
import { Link, useNavigate } from 'react-router-dom'

export default function Welcome() {
  const [isLoggedIn, setIsLoggedIn] = useState(false)

  const navigate = useNavigate()

  // token
  const token = localStorage.getItem('token')

  useEffect(() => {
    if (token) {
      ;(async () => {
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

        try {
          await axios.get('http://127.0.0.1:8000/api/auth/profile')
          setIsLoggedIn(true)
        } catch (error) {
          setIsLoggedIn(false)
        }
      })()
    }
  }, [token])

  const logoutHandler = async () => {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

    await axios.post('http://127.0.0.1:8000/api/auth/logout')
    setIsLoggedIn(false)
    localStorage.removeItem('token')
    navigate('/login')
  }

  return (
    <div className='container'>
      <div className='d-flex align-items-center' style={{ height: '100vh' }}>
        <div style={{ width: '100%' }}>
          <div className='row justify-content-center'>
            <div className='col-md-6'>
              <div className='card'>
                <div className='card-header'>Welcome</div>
                <div className='card-body'>
                  <h5>Dzulfikri Alkautsari</h5>
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Omnis, fugit!
                  </p>
                  {isLoggedIn ? (
                    <div>
                      <button
                        className='btn btn-danger'
                        onClick={logoutHandler}>
                        Logout
                      </button>
                      <Link to='/home' className='btn btn-info'>
                        Home
                      </Link>
                    </div>
                  ) : (
                    <div>
                      <Link
                        to='login'
                        className='btn btn-primary'
                        style={{ marginRight: 5 }}>
                        Login
                      </Link>
                      <Link to='register' className='btn btn-info'>
                        Register
                      </Link>
                    </div>
                  )}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
