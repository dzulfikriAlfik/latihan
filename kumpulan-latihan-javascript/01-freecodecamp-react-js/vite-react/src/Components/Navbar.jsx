import reactLogo from "../assets/react.svg";

function Navbar() {
  return (
    <nav className="nav">
      <div className="nav-left">
        <img src={reactLogo} alt="react-logo" />
        <h3>ReactFacts</h3>
      </div>
      <div className="nav-right">
        <h4>React Course - Project 1</h4>
      </div>
    </nav>
  );
}

export default Navbar;
