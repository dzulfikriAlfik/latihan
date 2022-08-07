import MemeData from "../Data/MemeData";
import { useState } from "react";

function Meme() {
  let memes = MemeData.data.memes;

  let [imageUrl, setImageUrl] = useState("http://i.imgflip.com/1bij.jpg");

  function getMemeImage() {
    let rand = Math.floor(Math.random() * memes.length);
    let newImageUrl = memes[rand].url;
    console.log(newImageUrl);
    setImageUrl(newImageUrl);
  }

  return (
    <main>
      <div className="form">
        <input type="text" className="form--input" placeholder="Top Text" />
        <input type="text" className="form--input" placeholder="Bottom Text" />
        <button onClick={getMemeImage} className="form--button">
          Get a new meme image
        </button>
      </div>
      <img src={imageUrl} className="meme--image" />
    </main>
  );
}

export default Meme;
