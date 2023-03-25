import React, { createContext, useContext, useEffect, useState } from 'react'
import { View, ActivityIndicator } from 'react-native'
import { NavigationContainer } from '@react-navigation/native'
import { createStackNavigator } from '@react-navigation/stack'
import { onAuthStateChanged } from 'firebase/auth'

import Chat from './screens/Chat'
import Login from './screens/Login'
import Signup from './screens/Signup'
import Home from './screens/Home'
import { auth } from './config/firebase'

const Stack = createStackNavigator()
const AuthenticatedUserContext = createContext({})

const AuthenticatedUserProvider = ({ children }) => {
  const [user, setUser] = useState(null)

  return (
    <AuthenticatedUserContext.Provider value={{ user, setUser }}>
      {children}
    </AuthenticatedUserContext.Provider>
  )
}

function ChatStack() {
  return (
    <Stack.Navigator defaultScreenOptions={Home}>
      <Stack.Screen name='Home' component={Home}></Stack.Screen>
      <Stack.Screen name='Chat' component={Chat}></Stack.Screen>
    </Stack.Navigator>
  )
}

function AuthStack() {
  return (
    <Stack.Navigator
      screenOptions={{ headerShown: false }}
      defaultScreenOptions={Login}>
      <Stack.Screen name='Login' component={Login}></Stack.Screen>
      <Stack.Screen name='Signup' component={Signup}></Stack.Screen>
    </Stack.Navigator>
  )
}

function RootNavigator() {
  const { user, setUser } = useContext(AuthenticatedUserContext)
  const [isLoading, setIsLoading] = useState(true)

  useEffect(() => {
    const unsubscribe = onAuthStateChanged(auth, async (authenticatedUser) => {
      authenticatedUser ? setUser(authenticatedUser) : setUser(null)
      setIsLoading(false)
    })

    return () => unsubscribe()
  }, [user])

  if (isLoading) {
    return (
      <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
        <ActivityIndicator size='large'></ActivityIndicator>
      </View>
    )
  }

  return (
    <NavigationContainer>
      {user ? <ChatStack /> : <AuthStack />}
    </NavigationContainer>
  )
}

export default function App() {
  return (
    <AuthenticatedUserProvider>
      <RootNavigator />
    </AuthenticatedUserProvider>
  )
}
