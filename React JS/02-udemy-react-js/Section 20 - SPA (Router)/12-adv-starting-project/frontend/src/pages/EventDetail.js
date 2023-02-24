import { json, redirect, useRouteLoaderData } from 'react-router-dom'
import EventItem from '../components/EventItem'

export default function EventDetailPage() {
  const data = useRouteLoaderData('event-detail')

  const event = data.event

  return <EventItem event={event} />
}

export async function loader({ params }) {
  const eventId = params.eventId

  const response = await fetch(`http://localhost:8080/events/${eventId}`)

  if (!response.ok) {
    throw json(
      { message: 'Coud not fetch for selected event!' },
      { status: 500 }
    )
  } else {
    return response
  }
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
