import { createSlice } from "@reduxjs/toolkit";

const favoriteSlice = createSlice({
  name: "favorites",
  initialState: {
    ids: [],
  },
  reducers: {
    addFavorie: (state, action) => {
      state.ids.push(action.payload.id);
    },
    removeFavorie: (state, action) => {
      state.ids.splice(state.ids.indexOf(action.payload.id), 1);
    },
  },
});

export const addFavorie = favoriteSlice.actions.addFavorie;
export const removeFavorie = favoriteSlice.actions.removeFavorie;
export default favoriteSlice.reducer;
