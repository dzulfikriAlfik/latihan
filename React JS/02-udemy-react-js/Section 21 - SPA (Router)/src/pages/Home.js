import { Link, useNavigate } from 'react-router-dom'

export default function HomePage() {
  const navigate = useNavigate()

  function navigateHandler() {
    navigate('/products')
  }

  return (
    <>
      <h1>My Homepage</h1>
      <p>
        Go To <Link to='/products'>List of products</Link>
      </p>
      <p>
        <button onClick={navigateHandler}>Navigate</button>
      </p>
    </>
  )
}
