import { useContext } from "react";

import FavoritesContext from "../store/favorite-context";
import MeetupList from "../components/meetups/MeetupList";

function FavoritesPage() {
  const favoriteCtx = useContext(FavoritesContext);

  return (
    <section>
      <h1>My Favorites</h1>
      {favoriteCtx.totalFavorites === 0 ? (
        <p>You got no favorites yet. Start adding some?</p>
      ) : (
        <MeetupList meetups={favoriteCtx.favorites} />
      )}
    </section>
  );
}

export default FavoritesPage;
