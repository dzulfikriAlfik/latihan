// import { Component } from 'react'
import React from 'react'
import {
  useSelector,
  useDispatch,
  // connect
} from 'react-redux'
import { counterActions } from '../store/counter'
import classes from './Counter.module.css'

const Counter = () => {
  const dispatch = useDispatch()
  const counter = useSelector((state) => state.counter.value)
  const showCounter = useSelector((state) => state.counter.showCounter)

  const incrementHandler = (count = 1) => {
    dispatch(counterActions.increment(count))
  }

  const decrementHandler = () => {
    dispatch(counterActions.decrement())
  }

  const toggleCounterHandler = () => {
    dispatch(counterActions.toggle())
  }

  const resetCounterHandler = () => {
    dispatch(counterActions.reset())
  }

  return (
    <main className={classes.counter}>
      <h1>Redux Counter</h1>
      {showCounter && <div className={classes.value}>{counter}</div>}
      <div>
        <button onClick={() => incrementHandler(1)}>Increment</button>
        <button onClick={() => incrementHandler(5)}>Increase by 5</button>
        <button onClick={decrementHandler}>Decrement</button>
      </div>
      <button onClick={toggleCounterHandler}>Toggle Counter</button>
      <button onClick={resetCounterHandler}>Reset Counter</button>
    </main>
  )
}

// class Counter extends Component {
//   incrementHandler() {
//     this.props.increment()
//   }

//   decrementHandler() {
//     this.props.decrement()
//   }

//   toggleCounterHandler() {}

//   render() {
//     return (
//       <main className={classes.counter}>
//         <h1>Redux Counter</h1>
//         <div className={classes.value}>{this.props.counter}</div>
//         <div>
//           <button onClick={this.incrementHandler.bind(this)}>Increment</button>
//           <button onClick={this.decrementHandler.bind(this)}>Decrement</button>
//         </div>
//         <button onClick={this.toggleCounterHandler}>Toggle Counter</button>
//       </main>
//     )
//   }
// }

// const mapStateToProps = (state) => {
//   return {
//     counter: state.counter,
//   }
// }

// const mapDispatchToProps = (dispatch) => {
//   return {
//     increment: () => dispatch({ type: 'increment' }),
//     decrement: () => dispatch({ type: 'decrement' }),
//   }
// }

// export default connect(mapStateToProps, mapDispatchToProps)(Counter)
export default Counter
