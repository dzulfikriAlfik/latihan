import React, { useState, useEffect, useRef } from "react";

import Card from "../UI/Card";
import ErrorModal from "../UI/ErrorModal";
import useHttp from "../../hooks/http";
import "./Search.css";

const Search = React.memo((props) => {
  const { onLoadedIngredients } = props;
  const [enteredFilter, setEnteredFilter] = useState("");
  const inputRef = useRef();
  const { isLoading, data, error, sendRequest, clearHttp } = useHttp();

  useEffect(() => {
    const timer = setTimeout(() => {
      if (enteredFilter === inputRef.current.value) {
        const query =
          enteredFilter.length === 0
            ? ""
            : `?orderBy="title"&equalTo="${enteredFilter}"`;

        sendRequest(
          `https://my-test-project-bd9da-default-rtdb.firebaseio.com/ingredients.json${query}`,
          "GET"
        );
      }
    }, 500);
    /** di useEffect kita bisa me return function. biasanya untuk proses cleanup */
    return () => {
      clearTimeout(timer);
    };
  }, [enteredFilter, inputRef, sendRequest]);

  useEffect(() => {
    if (!isLoading && !error && data) {
      const loadedIngredients = [];
      for (const key in data) {
        loadedIngredients.push({
          id: key,
          title: data[key].title,
          amount: data[key].amount,
        });
      }

      onLoadedIngredients(loadedIngredients);
    }
  }, [data, isLoading, error, onLoadedIngredients]);

  return (
    <section className="search">
      {error && <ErrorModal onClose={clearHttp}>{error}</ErrorModal>}

      <Card>
        <div className="search-input">
          <label>Filter by Title</label>
          {isLoading && <span>Loading...</span>}
          <input
            ref={inputRef}
            type="text"
            value={enteredFilter}
            onChange={(event) => setEnteredFilter(event.target.value)}
          />
        </div>
      </Card>
    </section>
  );
});

export default Search;
