// File System
const fs = require('fs')
// readline
const readline = require('readline')

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout,
})

const dirPath = './data'

if (!fs.existsSync(dirPath)) {
  fs.mkdirSync(dirPath)
}

const dataPath = `${dirPath}/contacts.json`

if (!fs.existsSync(dataPath)) {
  fs.writeFileSync(dataPath, '[]', 'utf-8')
}

const question = (label) => {
  return new Promise((resolve, reject) => {
    rl.question(label, (answer) => {
      resolve(answer)
    })
  })
}

const saveToContacts = (name, email, mobilePhone) => {
  fs.readFile(dataPath, 'utf-8', (err, data) => {
    if (err) throw err

    const newData = JSON.parse(data)

    newData.push({ name, email, mobilePhone })

    fs.writeFile(dataPath, JSON.stringify(newData), (err) => {
      console.log(err)
    })
  })

  console.log(`Terimakasih ${name}, telah mengisi formulir kontak.`)

  rl.close()
}

module.exports = { question, saveToContacts }
