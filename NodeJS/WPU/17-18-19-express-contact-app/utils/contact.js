// File System
const fs = require('fs')

const dirPath = './data'
const dataPath = `${dirPath}/contacts.json`

if (!fs.existsSync(dirPath)) {
  fs.mkdirSync(dirPath)
}

if (!fs.existsSync(dataPath)) {
  fs.writeFileSync(dataPath, '[]', 'utf-8')
}

const loadContacts = () => {
  const fileBuffer = fs.readFileSync(dataPath, 'utf-8')
  return JSON.parse(fileBuffer)
}

const findContact = (nama) => {
  return loadContacts().find(
    (data) => data.nama.toLowerCase() === nama.toLowerCase()
  )
}

// menuliskan / menimpa file contacts.json dengan data yang baru
const saveContacts = (contacts) => {
  fs.writeFileSync(dataPath, JSON.stringify(contacts))
}

// menambahkan data contact baru
const addContact = ({ nama, email, nohp }) => {
  const contacts = loadContacts()
  const isDuplicated = contacts.find((contact) => contact.nama === nama)

  if (isDuplicated) return false

  contacts.push({ nama, email, nohp })

  saveContacts(contacts)
}

const deleteContacts = (name) => {
  const contacts = loadContacts()
  const newContact = contacts.filter(
    (contact) => contact.name.toLowerCase() !== name.toLowerCase()
  )

  if (newContact.length === contacts.length)
    return printError(`${name} tidak ditemukan`)

  fs.writeFile(dataPath, JSON.stringify(newContact), (err) => {
    console.log(err)
    return
  })

  return printSuccess(`${name} berhasil dihapus`)
}

module.exports = {
  loadContacts,
  findContact,
  addContact,
  deleteContacts,
}
