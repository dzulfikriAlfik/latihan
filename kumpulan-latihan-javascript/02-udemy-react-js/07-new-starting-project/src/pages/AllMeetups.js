import { useState, useEffect } from "react";
import MeetupList from "../components/meetups/MeetupList";

function AllMeetupsPage() {
  const [isLoading, setIsLoading] = useState(true);
  const [loadedMeetups, setLoadedMeetups] = useState([]);

  async function fetchMeetupsData() {
    const response = await fetch(
      "https://my-test-project-bd9da-default-rtdb.firebaseio.com/meetups.json"
    );

    return await response.json();
  }

  useEffect(async () => {
    setIsLoading(true);

    const data = await fetchMeetupsData();

    const meetups = [];

    for (const key in data) {
      const meetup = {
        id: key,
        ...data[key],
      };
      meetups.push(meetup);
    }

    setIsLoading(false);
    setLoadedMeetups(meetups);
  }, []);

  if (isLoading) {
    return (
      <section>
        <p>Loading...</p>
      </section>
    );
  }

  return (
    <section>
      <h1>All Meetups</h1>
      <MeetupList meetups={loadedMeetups} />
    </section>
  );
}

export default AllMeetupsPage;
