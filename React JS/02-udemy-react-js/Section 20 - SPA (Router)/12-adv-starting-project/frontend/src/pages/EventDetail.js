import { useParams } from 'react-router-dom'
import { DUMMY_EVENTS } from '../data/events'

export default function EventDetailPage() {
  const params = useParams()

  const event = DUMMY_EVENTS.find((event) => event.id === params.eventId)

  if (!event) {
    return (
      <>
        <h1>Event Not Found!</h1>
      </>
    )
  }

  return (
    <>
      <h1>EventDetail Page</h1>
      <p>Event ID : {event.id}</p>
      <p>Event Title : {event.title}</p>
    </>
  )
}
