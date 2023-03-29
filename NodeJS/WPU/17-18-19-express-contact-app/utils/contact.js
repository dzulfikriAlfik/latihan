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

const findContact = (name) => {
  return loadContacts().find((data) => data.name === name)
}

// menuliskan / menimpa file contacts.json dengan data yang baru
const saveContacts = (contacts) => {
  fs.writeFileSync(dataPath, JSON.stringify(contacts))
}

// menambahkan data contact baru
const addContact = (contact) => {
  const contacts = loadContacts()

  contacts.push(contact)

  saveContacts(contacts)
}

const updateContact = (newContact) => {
  const filteredContact = loadContacts().filter(
    (oldContact) => oldContact.name !== newContact.oldName
  )

  delete newContact.oldName // delete object key oldName

  filteredContact.push(newContact)

  saveContacts(filteredContact)
}

const deleteContact = (name) => {
  const filteredContact = loadContacts().filter(
    (contact) => contact.name !== name
  )

  saveContacts(filteredContact)
}

module.exports = {
  loadContacts,
  findContact,
  addContact,
  updateContact,
  deleteContact,
}
