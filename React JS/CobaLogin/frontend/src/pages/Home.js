import axios from 'axios'
import React, { useEffect, useState } from 'react'
import { Link, useNavigate } from 'react-router-dom'

export default function Home() {
  const [user, setUser] = useState({})

  const navigate = useNavigate()

  // token
  const token = localStorage.getItem('token')

  useEffect(() => {
    if (!token) {
      navigate('/login')
    }

    ;(async () => {
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

      try {
        const res = await axios.get('http://127.0.0.1:8000/api/auth/profile')
        setUser(res.data)
      } catch (error) {
        if (error.response.status === 401) {
          navigate('/login')
          localStorage.removeItem('token')
        }
      }
    })()
  }, [token, navigate])

  const logoutHandler = async () => {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

    await axios.post('http://127.0.0.1:8000/api/auth/logout')
    setUser('')
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
                <div className='card-header'>Home</div>
                <div className='card-body'>
                  <h5>{user.name}</h5>
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Omnis, fugit!
                  </p>
                  <button className='btn btn-danger' onClick={logoutHandler}>
                    Logout
                  </button>
                  <Link to='/' className='btn btn-info'>
                    Homepage
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
