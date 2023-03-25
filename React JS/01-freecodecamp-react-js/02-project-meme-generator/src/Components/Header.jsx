function Header() {
  return (
    <header className="header">
      <img
        src={`${assetsUrl}images/troll-face.png`}
        className="header--image"
      />
      <h2 className="header--title">Meme Generator</h2>
      <h4 className="header--project">React Couse - Project 2</h4>
    </header>
  );
}

export default Header;
