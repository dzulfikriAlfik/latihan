import { useState } from "react";
import Modal from "./Modal";
import Backdrop from "./Backdrop";

function Todo(props) {
  const [modalIsOpen, setModaIsOpen] = useState(false);

  function deleteHandler() {
    setModaIsOpen(true);
  }

  function closeModalHandler() {
    setModaIsOpen(false);
  }

  function confirmHandler() {
    setModaIsOpen(false);
    console.log("Confirmed");
  }

  return (
    <div className="card">
      <h2>{props.text}</h2>
      <div className="actions">
        <button className="btn" onClick={deleteHandler}>
          Delete
        </button>
      </div>
      {modalIsOpen && (
        <div>
          <Modal
            cancelHander={closeModalHandler}
            confirmHandler={confirmHandler}
          />
          <Backdrop cancelHander={closeModalHandler} />
        </div>
      )}
    </div>
  );
}

export default Todo;
