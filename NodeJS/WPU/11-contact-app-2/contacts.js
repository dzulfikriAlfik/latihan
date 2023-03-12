// File System
const fs = require('fs')
const chalk = require('chalk')
const validator = require('validator')

const dirPath = './data'
const dataPath = `${dirPath}/contacts.json`

if (!fs.existsSync(dirPath)) {
  fs.mkdirSync(dirPath)
}

if (!fs.existsSync(dataPath)) {
  fs.writeFileSync(dataPath, '[]', 'utf-8')
}

const printSuccess = (message) => {
  console.log(chalk.greenBright.inverse(message))
}

const printError = (message) => {
  console.log(chalk.red.inverse(message))
}

const loadContacts = () => {
  const fileBuffer = fs.readFileSync(dataPath, 'utf-8')
  return JSON.parse(fileBuffer)
}

const showLists = () => {
  const listsData = loadContacts()
  const countData = listsData.length

  if (countData === 0) {
    return printError(`Kontak masih kosong`)
  }

  printSuccess(`Menampilkan ${countData} total kontak.`)

  console.log('---------------------------')

  for (i in listsData) {
    console.log(
      `${parseInt(i) + 1}. ${listsData[i].name} - ${listsData[i].phone}`
    )
  }
}

const saveToContacts = (name, email, phone) => {
  const constacts = loadContacts()
  const isDuplicated = constacts.find((contact) => contact.name === name)

  if (isDuplicated) {
    return printError(`Opps ${name} sudah ada di contact. Gunakan nama lain!`)
  }

  if (email) {
    if (!validator.isEmail(email)) {
      return printError(`Opps email tidak valid!`)
    }
  }

  if (!validator.isMobilePhone(phone, 'id-ID')) {
    return printError(`Opps nomor hp tidak valid!`)
  }

  constacts.push({ name, email, phone })

  fs.writeFile(dataPath, JSON.stringify(constacts), (err) => {
    console.log(err)
    return
  })

  return printSuccess(`Terimakasih ${name}, telah mengisi formulir kontak.`)
}

const deleteContacts = (name) => {
  const constacts = loadContacts()
  const newContact = constacts.filter(
    (contact) => contact.name.toLowerCase() !== name.toLowerCase()
  )

  if (newContact.length === constacts.length)
    return printError(`${name} tidak ditemukan`)

  fs.writeFile(dataPath, JSON.stringify(newContact), (err) => {
    console.log(err)
    return
  })

  return printSuccess(`${name} berhasil dihapus`)
}

module.exports = { saveToContacts, deleteContacts, showLists }
