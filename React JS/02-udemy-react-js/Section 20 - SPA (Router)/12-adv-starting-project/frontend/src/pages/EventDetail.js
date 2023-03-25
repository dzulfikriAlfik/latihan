import { Suspense } from 'react'
import {
  defer,
  json,
  redirect,
  useRouteLoaderData,
  Await,
} from 'react-router-dom'
import EventItem from '../components/EventItem'
import EventsList from '../components/EventsList'

function EventDetailPage() {
  const { event, events } = useRouteLoaderData('event-detail')

  return (
    <>
      <Suspense fallback={<p style={{ textAlign: 'center' }}>Loading</p>}>
        <Await resolve={event}>
          {(loadedEvent) => <EventItem event={loadedEvent} />}
        </Await>
      </Suspense>
      <Suspense fallback={<p style={{ textAlign: 'center' }}>Loading...</p>}>
        <Await resolve={events}>
          {(loadedEvents) => <EventsList events={loadedEvents} />}
        </Await>
      </Suspense>
    </>
  )
}

export default EventDetailPage

async function loadEvent(id) {
  const response = await fetch(`http://localhost:8080/events/${id}`)

  if (!response.ok) {
    throw json(
      { message: 'Coud not fetch for selected event!' },
      { status: 500 }
    )
  }

  const resData = await response.json()
  console.log(resData)
  return resData.event
}

async function loadEvents(eventId) {
  const response = await fetch('http://localhost:8080/events')

  if (response.ok === false) {
    // throw new Response(JSON.stringify({ message: 'Could not fetch events.' }), {
    //   status: 500,
    // })
    throw json({ message: 'Could not fetch events.' }, { status: 500 })
  }

  const resData = await response.json()
  return resData.events.filter((event) => event.id !== eventId)
}

export async function loader({ params }) {
  const eventId = params.eventId

  return defer({
    event: await loadEvent(eventId),
    events: loadEvents(eventId),
  })
}

export async function action({ params, request }) {
  const eventId = params.eventId

  const response = await fetch(`http://localhost:8080/events/${eventId}`, {
    method: request.method,
  })

  if (!response.ok) {
    throw json({ message: 'Coud not delete event!' }, { status: 500 })
  }

  return redirect('/events')
}
