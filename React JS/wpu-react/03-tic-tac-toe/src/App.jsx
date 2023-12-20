/* eslint-disable react/prop-types */
import { useState } from 'react'

export default function Game() {
  const [history, setHistory] = useState([Array(9).fill(null)])
  const [currentMove, setCurrentMove] = useState(0)
  const currentSquares = history[currentMove]
  const xIsNext = currentMove % 2 === 0

  function jumpTo(nextMove) {
    setCurrentMove(nextMove)
  }

  function handlePlay(nextSquare) {
    const nextHistory = [...history.slice(0, currentMove + 1), nextSquare]
    setHistory(nextHistory)
    setCurrentMove(nextHistory.length - 1)
  }

  const moves = history.map((squares, move) => {
    let description = ''

    if (move > 0) {
      description = `Go to move #${move}`
    } else {
      description = 'Go to game start'
    }

    return (
      <li key={move}>
        <button onClick={() => jumpTo(move)}>{description}</button>
      </li>
    )
  })

  return (
    <div className='game'>
      <div className='game-board'>
        <Board xIsNext={xIsNext} squares={currentSquares} onPlay={handlePlay} />
      </div>
      <div className='game-info'>
        <ol>{moves}</ol>
      </div>
    </div>
  )
}

function Board({ xIsNext, squares, onPlay }) {
  const handleSquareClick = (i) => {
    if (squares[i] || calculateWinner(squares)) return

    const nextSquare = squares.slice()

    nextSquare[i] = xIsNext ? 'X' : 'O'

    onPlay(nextSquare)
  }

  const winner = calculateWinner(squares)
  let status = ''

  if (winner) {
    status = `Winner : ${winner}`
  } else {
    status = `Next player : ${xIsNext ? 'X' : 'O'}`
  }

  return (
    <>
      <div className='status'>{status}</div>
      <div className='board'>
        {squares.map((value, index) => (
          <Square
            key={Math.random()}
            value={squares[index]}
            onSquareClick={() => handleSquareClick(index)}
          />
        ))}
      </div>
    </>
  )
}

function Square({ value, onSquareClick }) {
  return (
    <button className='square' onClick={onSquareClick}>
      {value}
    </button>
  )
}

// Helper
function calculateWinner(squares) {
  const lines = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6],
  ]

  for (let i = 0; i < lines.length; i++) {
    const [a, b, c] = lines[i]
    // [ "X","X","X","O","O",null,null,null,null]
    if (squares[a] && squares[a] === squares[b] && squares[c] === squares[b]) {
      return squares[a]
    }
  }

  return false
}
