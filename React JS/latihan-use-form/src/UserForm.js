import Select from 'react-select'
import { useForm, useController } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import { string, z } from 'zod'

const schema = z.object({
  name: string().min(1, { message: 'Name is required' }),
  email: string().email(),
  website: string().url().optional(),
  country: string(),
})

const countryOptions = [
  { value: 'asgard', label: 'Asgard' },
  { value: 'indonesia', label: 'Indonesia' },
  { value: 'usa', label: 'USA' },
]

export default function UserForm({ onSave, user = {} }) {
  const { register, control, handleSubmit, formState } = useForm({
    defaultValues: user,
    resolver: zodResolver(schema),
  })

  const { field } = useController({ name: 'country', control })

  const { errors } = formState

  // const validateData = () => {
  //   let errors = {}

  //   if (!name) {
  //     errors.name = 'Name is required'
  //   }

  //   if (!validator.isEmail(email)) {
  //     errors.email = 'A valid email is required'
  //   }

  //   if (!validator.isURL(website)) {
  //     errors.website = 'A valid website is required'
  //   }

  //   if (!country) {
  //     errors.country = 'A country is required'
  //   }

  //   return errors
  // }

  const handleSelectChange = (option) => {
    field.onChange(option.value)
  }

  const handleSave = (formValues) => {
    onSave(formValues)
  }

  return (
    <form onSubmit={handleSubmit(handleSave)}>
      <div>
        <p>Name</p>
        <input {...register('name')} />
        <div style={{ color: 'red' }}>{errors.name?.message}</div>
      </div>
      <hr />
      <div>
        <p>Email</p>
        <input {...register('email')} />
        <div style={{ color: 'red' }}>{errors.email?.message}</div>
      </div>
      <hr />
      <div>
        <p>Website</p>
        <input {...register('website')} />
        <div style={{ color: 'red' }}>{errors.website?.message}</div>
      </div>
      <hr />
      <div>
        <p>Country</p>
        <Select
          {...register('country')}
          value={countryOptions.find(({ value }) => value === field.value)}
          onChange={handleSelectChange}
          options={countryOptions}
        />
        <div style={{ color: 'red' }}>{errors.country?.message}</div>
      </div>
      <hr />
      <div style={{ marginTop: '12px' }}>
        <button type='submit'>Save</button>
      </div>
    </form>
  )
}
