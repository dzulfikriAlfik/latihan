import { createContext, useEffect, useState } from 'react'

const AuthContext = createContext({
  isLoggedIn: false,
  onLogin: () => {},
  onLogout: () => {},
})

export const AuthContextProvider = ({ children }) => {
  const [isLoggedIn, setIsLoggedIn] = useState(false)

  useEffect(() => {
    if (localStorage.getItem('isLoggedIn') === '1') {
      setIsLoggedIn(true)
    }
  }, [isLoggedIn])

  const loginHanlder = (email, password) => {
    localStorage.setItem('isLoggedIn', '1')
    setIsLoggedIn(true)
  }

  const logoutHandler = () => {
    localStorage.removeItem('isLoggedIn')
    setIsLoggedIn(false)
  }

  const values = {
    isLoggedIn: isLoggedIn,
    onLogin: loginHanlder,
    onLogout: logoutHandler,
  }

  return <AuthContext.Provider value={values}>{children}</AuthContext.Provider>
}

export default AuthContext
