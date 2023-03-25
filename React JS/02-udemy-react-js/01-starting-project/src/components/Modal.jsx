export default function Modal(props) {
  return (
    <div className="modal">
      <p>Are you sure?</p>
      <button className="btn btn--alt" onClick={props.cancelHander}>
        Cancel
      </button>
      <button className="btn" onClick={props.confirmHandler}>
        Confirm
      </button>
    </div>
  );
}
