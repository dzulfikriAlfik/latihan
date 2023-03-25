import airBnbLogo from "../assets/images/airbnb-logo.png";

function Navbar() {
  return (
    <nav>
      <img src={airBnbLogo} alt="Airbnb Logo" className="nav--logo" />
    </nav>
  );
}

export default Navbar;
