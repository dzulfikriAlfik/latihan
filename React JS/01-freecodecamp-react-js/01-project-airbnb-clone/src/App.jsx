import Navbar from "./Components/Navbar";
import Hero from "./Components/Hero";
import Card from "./Components/Card";
import CardData from "./Data/CardData";

function App() {
  const Cards = CardData.map((data) => <Card key={data.key} {...data} />);

  return (
    <div className="App">
      <Navbar />
      <Hero />
      <div className="cards">{Cards}</div>
    </div>
  );
}

export default App;

/**
 * Notes :
 * ketika ingin passing parameter, nama parameter yang dikirim harus sama
 * dengan props yang diterima
 */
