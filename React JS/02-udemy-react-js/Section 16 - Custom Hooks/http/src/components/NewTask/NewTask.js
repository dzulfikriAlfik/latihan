import Section from '../UI/Section'
import TaskForm from './TaskForm'
import useHttp from '../../hooks/use-http'

const NewTask = (props) => {
  const { isLoading, error, sendRequest: sendTaskRequest } = useHttp()

  const createTask = (taskText, data) => {
    const generatedId = data.name
    const createdTask = { id: generatedId, text: taskText }

    props.onAddTask(createdTask)
  }

  const enterTaskHandler = async (taskText) => {
    sendTaskRequest(
      {
        url: 'https://react-http-696be-default-rtdb.asia-southeast1.firebasedatabase.app/tasks.json',
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: { text: taskText },
      },
      createTask.bind(null, taskText)
    )
  }

  return (
    <Section>
      <TaskForm onEnterTask={enterTaskHandler} loading={isLoading} />
      {error && <p>{error}</p>}
    </Section>
  )
}

export default NewTask
