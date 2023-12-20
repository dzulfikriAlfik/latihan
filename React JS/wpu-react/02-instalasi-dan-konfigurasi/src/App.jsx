import { useState } from 'react'
import Header from './components/Header'

function App() {
  const [likes, setLikes] = useState(0)

  function handleClick() {
    setLikes((prevLikes) => prevLikes + 1)
  }

  return (
    <>
      <Header />
      <Header author='Dzulfikri' />
      <button onClick={handleClick}>Like ({likes})</button>
    </>
  )
}

export default App
