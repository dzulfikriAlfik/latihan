import Die from "./components/Die";
import { useState, useEffect } from "react";
import { nanoid } from "nanoid";
import ReactConfetti, { confetti } from "react-confetti";
import "./assets/css/style.css";

function App() {
  const [dice, setDice] = useState(allNewDice());
  const [tenzies, setTenzies] = useState(false);

  useEffect(() => {
    const allHeld = dice.every((die) => die.isHeld);
    const firstValue = dice[0].value;
    const allSameValue = dice.every((die) => die.value === firstValue);
    if (allHeld && allSameValue) {
      setTenzies(true);
    }
  }, [dice]);

  function generateNewDie() {
    return {
      value: Math.ceil(Math.random() * 6),
      isHeld: false,
      id: nanoid(),
    };
  }

  function allNewDice() {
    const newDice = [];
    for (let i = 1; i <= 10; i++) {
      newDice.push(generateNewDie());
    }
    return newDice;
  }

  function rollDice() {
    setDice((oldDice) => {
      return oldDice.map((die) => {
        return die.isHeld ? die : generateNewDie();
      });
    });
  }

  function holdDice(id) {
    setDice((oldDice) => {
      return oldDice.map((die) => {
        return die.id === id ? { ...die, isHeld: !die.isHeld } : die;
      });
    });
  }

  function resetGame() {
    setTenzies(false);
    setDice(allNewDice());
  }

  const myDice = dice.map((die) => (
    <Die
      key={die.id}
      value={die.value}
      isHeld={die.isHeld}
      handleClick={() => holdDice(die.id)}
    />
  ));

  return (
    <main>
      <h1>Tenzies</h1>
      <p className="info-text">
        Roll until dice are the same. Click each die to freeze it at its current
        value between rolls.
      </p>
      <div className="dice-container">{myDice}</div>
      {tenzies && <p>You won the game</p>}
      {(!tenzies && <button onClick={rollDice}>Roll</button>) || (
        <div>
          <ReactConfetti />
          <button onClick={resetGame}>Reset the game</button>
        </div>
      )}
    </main>
  );
}

export default App;
