function Navbar() {
  return (
    <nav className="navbar">
      <img src="./react-logo.png" alt="React Logo" />
      <ul className="nav-items">
        <li>Pricing</li>
        <li>About</li>
        <li>Contact</li>
      </ul>
    </nav>
  );
}

function MainContent() {
  return (
    <div>
      <h1>Fun facts about react</h1>
      <ul>
        <li>Lorem ipsum dolor sit amet.</li>
        <li>Lorem ipsum dolor sit amet consectetur.</li>
        <li>Lorem, ipsum dolor.</li>
        <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</li>
      </ul>
    </div>
  );
}

const Page = function () {
  let name = "Dzulfikri";
  if (name == "Dzulfikri") {
    return (
      <div>
        <Navbar />
        <MainContent />
      </div>
    );
  } else {
    return <h1>Wrong name!</h1>;
  }
};

ReactDOM.render(<Page />, document.getElementById("root"));
// ReactDOM.render(<MainContent />, document.getElementById("root2"));
