import { useState, useEffect } from "react";

function Meme() {
  const [meme, setMeme] = useState({
    topText: "",
    bottomText: "",
    randomImage: "http://i.imgflip.com/1bij.jpg",
  });

  const [allMemes, setAllMemes] = useState([]);

  useEffect(() => {
    (async () => {
      const response = await fetch("https://api.imgflip.com/get_memes");
      const data = await response.json();
      setAllMemes(data.data.memes);
    })();
  }, []);

  function getMemeImage() {
    let rand = Math.floor(Math.random() * allMemes.length);
    let newImageUrl = allMemes[rand].url;
    setMeme((prevMeme) => ({
      ...prevMeme,
      randomImage: newImageUrl,
    }));
  }

  function handleChange(event) {
    const { name, value } = event.target;

    setMeme((prevMeme) => ({
      ...prevMeme,
      // topText: name == "topText" ? value : prevMeme.topText,
      // bottomText: name == "bottomText" ? value : prevMeme.bottomText,
      // sama dengan
      [name]: value,
    }));
  }

  return (
    <main>
      <div className="form">
        <input
          type="text"
          id="top-text"
          className="form--input"
          placeholder="Top Text"
          name="topText"
          value={meme.topText}
          onChange={handleChange}
        />
        <input
          type="text"
          id="bottom-text"
          className="form--input"
          placeholder="Bottom Text"
          name="bottomText"
          value={meme.bottomText}
          onChange={handleChange}
        />
        <button onClick={getMemeImage} className="form--button">
          Get a new meme image
        </button>
      </div>
      <div className="meme">
        <img src={meme.randomImage} className="meme--image" />
        <h2 className="meme--text top">{meme.topText}</h2>
        <h2 className="meme--text bottom">{meme.bottomText}</h2>
      </div>
    </main>
  );
}

export default Meme;
