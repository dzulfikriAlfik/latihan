import starIcon from "../assets/images/star.png";

function Card(props) {
  let badgeText;
  if (props.openSpot === 0) {
    badgeText = "SOLD OUT";
  } else if (props.location === "Online") {
    badgeText = "ONLINE";
  }

  // const { imageFileName, rating, reviewCount, country, title, price } = props;
  return (
    <div className="card">
      <div className="card--image__section">
        <img
          src={`${assetsUrl}images/${props.img}`}
          alt="Katie Image"
          className="card--image"
        />
        {badgeText && <span className="card--badge">{badgeText}</span>}
      </div>
      <div className="card--stats">
        <img src={starIcon} alt="Star Icon" className="card--star" />
        <span>{props.stats.rating}</span>
        <span className="gray">({props.stats.reviewCount}) | &nbsp;</span>
        <span className="gray">{props.country}</span>
      </div>
      <p>{props.title}</p>
      <p>
        <span className="bold">From ${props.price}</span> / person
      </p>
    </div>
  );
}

export default Card;

/**
 * sytax dibawah ini
 * {!openSpot && <span className="card--badge">SOLD OUT</span>}
 * kondisi disebelah kiri dari syntax && bernilai truthy/falsy, jika sesuai maka kondisi
 * disebelah kanan akan dijalankan
 *
 * sama dengan ternary operator
 * {!openSpot ? "blablabla" : ""}
 */
