import { useEffect, useState } from 'react'
import Card from '../UI/Card'
import classes from './AvailableMeals.module.css'
import MealItem from './MealItem/MealItem'

const AvailableMeals = () => {
  const [meals, setMeals] = useState([])
  const [isLoading, setIsLoading] = useState(true)
  const [httpError, setHttpError] = useState()

  useEffect(() => {
    const fetchMeals = async () => {
      const response = await fetch(
        'https://react-http-696be-default-rtdb.asia-southeast1.firebasedatabase.app/meals.json'
      )

      if (!response.ok) {
        throw new Error(
          `Something wen't wrong : ${response.status} ${response.statusText}`
        )
      }

      const responseData = await response.json()
      const loadedMeals = []

      for (const index in responseData) {
        loadedMeals.push({
          id: index,
          name: responseData[index].name,
          description: responseData[index].description,
          price: responseData[index].price,
        })
      }

      setMeals(loadedMeals)
      setIsLoading(false)
    }

    fetchMeals().catch((error) => {
      setIsLoading(false)
      setHttpError(error.message)
    })
  }, [])

  if (isLoading) {
    return (
      <section className={classes.mealsLoading}>
        <p>Loading...</p>
      </section>
    )
  }

  if (httpError) {
    return (
      <section className={classes.mealsError}>
        <p>{httpError}</p>
      </section>
    )
  }

  const mealsList = meals.map((meal) => (
    <MealItem
      id={meal.id}
      key={meal.id}
      name={meal.name}
      description={meal.description}
      price={meal.price}
    />
  ))

  return (
    <section className={classes.meals}>
      <Card>
        <ul>{mealsList}</ul>
      </Card>
    </section>
  )
}

export default AvailableMeals
