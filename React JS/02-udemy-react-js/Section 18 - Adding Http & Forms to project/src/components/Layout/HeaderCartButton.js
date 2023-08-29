import CartIcon from '../Cart/CartIcon'
import classes from './HeaderCartButton.module.css'
import useCartContext from '../../store/useCartContext'
import { useEffect, useState } from 'react'

const HeaderCartButton = (props) => {
  const [btnIsHiglighted, setBtnIsHiglighted] = useState(false)
  const cartCtx = useCartContext()
  const { items } = cartCtx

  const numberOfCartItems = items.reduce(
    (currNumber, item) => currNumber + item.amount,
    0
  )

  const buttonClasses = `${classes.button} ${
    btnIsHiglighted ? classes.bump : ''
  }`

  useEffect(() => {
    if (items.length === 0) {
      return
    }

    setBtnIsHiglighted(true)

    const timer = setTimeout(() => {
      setBtnIsHiglighted(false)
    }, 300)

    return () => {
      clearTimeout(timer)
    }
  }, [items])

  return (
    <button className={buttonClasses} onClick={props.onClick}>
      <span className={classes.icon}>
        <CartIcon />
      </span>
      <span>Your Cart</span>
      <span className={classes.badge}>{numberOfCartItems}</span>
    </button>
  )
}

export default HeaderCartButton
