import UserForm from './UserForm'

function App() {
  const user = {
    name: 'Dzulfikri Alkautsari',
    email: 'dzulfikri.alkautsari@gmail.com',
    website: 'https://jangobara.com',
    country: 'indonesia',
  }

  const handleSave = (values) => {
    console.log('From App : ', { values })
  }

  return (
    <div>
      <h1>React Forms</h1>
      <div>
        <UserForm onSave={handleSave} {...{ user }} />
      </div>
    </div>
  )
}

export default App
