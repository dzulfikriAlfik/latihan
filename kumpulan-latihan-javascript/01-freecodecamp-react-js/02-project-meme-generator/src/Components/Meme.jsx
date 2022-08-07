import MemeData from "../Data/MemeData";
import { useState } from "react";

function Meme() {
  let memes = MemeData.data.memes;

  const [meme, setMeme] = useState({
    topText: "",
    bottomText: "",
    randomImage: "http://i.imgflip.com/1bij.jpg",
  });

  const [allMemeImages, setAllMemeImages] = useState(memes);

  function getMemeImage() {
    let rand = Math.floor(Math.random() * allMemeImages.length);
    let newImageUrl = allMemeImages[rand].url;
    setMeme((prevMeme) => ({
      ...prevMeme,
      randomImage: newImageUrl,
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
        />
        <input
          type="text"
          id="bottom-text"
          className="form--input"
          placeholder="Bottom Text"
        />
        <button onClick={getMemeImage} className="form--button">
          Get a new meme image
        </button>
      </div>
      <img src={meme.randomImage} className="meme--image" />
    </main>
  );
}

export default Meme;
