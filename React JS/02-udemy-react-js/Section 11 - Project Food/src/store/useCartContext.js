import { useContext } from 'react'
import CartContext from './cart-context'

const useCartContext = () => {
  return useContext(CartContext)
}

export default useCartContext
