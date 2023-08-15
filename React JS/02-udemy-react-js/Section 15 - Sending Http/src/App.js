import React, { useCallback, useEffect, useState } from 'react'

import MoviesList from './components/MoviesList'
import AddMovie from './components/AddMovie'
import './App.css'

function App() {
  const [movies, setMovies] = useState([])
  const [isLoading, setIsLoading] = useState(false)
  const [error, setError] = useState(null)

  const fetchMoviesHandler = useCallback(async () => {
    try {
      setIsLoading(true)
      setError(null)

      const res = await fetch(
        `https://react-http-696be-default-rtdb.asia-southeast1.firebasedatabase.app/movies.json`
      )

      if (!res.ok) {
        throw new Error("Something wen't wrong!")
      }

      const data = await res.json()

      const loadedMovies = []

      for (const key in data) {
        loadedMovies.push({ id: key, ...data[key] })
      }

      setMovies(loadedMovies)
    } catch (error) {
      setError(error.message)
    } finally {
      setIsLoading(false)
    }
  }, [])

  useEffect(() => {
    fetchMoviesHandler()
  }, [fetchMoviesHandler])

  async function addMovieHandler(movie) {
    const response = await fetch(
      'https://react-http-696be-default-rtdb.asia-southeast1.firebasedatabase.app/movies.json',
      {
        method: 'POST',
        body: JSON.stringify(movie),
        headers: {
          'Content-Type': 'application/json',
        },
      }
    )

    const data = await response.json()

    setMovies((prevMovies) => [...prevMovies, { id: data.name, ...movie }])
  }

  let content = <p>Found no movies</p>

  if (movies.length) {
    content = <MoviesList movies={movies} />
  }

  if (error) {
    content = <p>{error}</p>
  }

  if (isLoading) {
    content = <p>Loading...</p>
  }

  return (
    <React.Fragment>
      <section>
        <AddMovie onAddMovie={addMovieHandler} />
      </section>
      <section>
        <button onClick={fetchMoviesHandler}>Fetch Movies</button>
      </section>
      <section>{content}</section>
    </React.Fragment>
  )
}

export default App
