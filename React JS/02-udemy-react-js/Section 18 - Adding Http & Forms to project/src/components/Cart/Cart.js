import { Fragment, useState } from 'react'
import useCartContext from '../../store/useCartContext'
import Modal from '../UI/Modal'
import classes from './Cart.module.css'
import CartItem from './CartItem'
import CheckOut from './CheckOut'

const Cart = (props) => {
  const [isCheckout, setIsCheckout] = useState(false)
  const [isSubmitting, setIsSubmitting] = useState(false)
  const [didSubmit, setDidSubmit] = useState(false)

  const cartCtx = useCartContext()

  const totalAmount = `$${cartCtx.totalAmount.toFixed(2)}`
  const hasItems = cartCtx.items.length > 0

  const cartItemRemoveHandler = (id) => {
    cartCtx.removeItem(id)
  }

  const cartItemAddHandler = (item) => {
    cartCtx.addItem({ ...item, amount: 1 })
  }

  const orderHandler = () => {
    setIsCheckout(true)
  }

  const submitOrderHandler = async (userData) => {
    setIsSubmitting(true)

    await fetch(
      'https://react-http-696be-default-rtdb.asia-southeast1.firebasedatabase.app/orders.json',
      {
        method: 'POST',
        body: JSON.stringify({
          user: userData,
          orderedItems: cartCtx.items,
        }),
      }
    )

    setIsSubmitting(false)
    setDidSubmit(true)
    cartCtx.clearCart()
  }

  const cartItems = cartCtx.items.map((cart) => (
    <CartItem
      key={cart.id}
      name={cart.name}
      price={cart.price}
      amount={cart.amount}
      onRemove={cartItemRemoveHandler.bind(null, cart.id)}
      onAdd={cartItemAddHandler.bind(null, cart)}
    />
  ))

  const cartModalContent = (
    <Fragment>
      <ul className={classes['cart-items']}>{cartItems}</ul>
      <div className={classes.total}>
        <span>Total Amount</span>
        <span>{totalAmount}</span>
      </div>
      {isCheckout && (
        <CheckOut onConfirm={submitOrderHandler} onCancel={props.onClose} />
      )}
      {!isCheckout && (
        <div className={classes.actions}>
          <button className={classes['button--alt']} onClick={props.onClose}>
            Close
          </button>
          {hasItems && (
            <button className={classes.button} onClick={orderHandler}>
              Order
            </button>
          )}
        </div>
      )}
    </Fragment>
  )

  const isSubmittingModalContent = <p>Sending order data...</p>

  const didSubmitModalContent = (
    <Fragment>
      <p>Successfully sent the orders!</p>
      <div className={classes.actions}>
        <button className={classes.button} onClick={props.onClose}>
          Close
        </button>
      </div>
    </Fragment>
  )

  return (
    <Modal onClose={props.onClose}>
      {!isSubmitting && !didSubmit && cartModalContent}{' '}
      {isSubmitting && isSubmittingModalContent}
      {!isSubmitting && didSubmit && didSubmitModalContent}
    </Modal>
  )
}

export default Cart
