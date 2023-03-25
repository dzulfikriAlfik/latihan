// File System
const fs = require('fs')

// const { text } = require('./text')

// console.log(fs)

// menuliskan string ke file (synchronously)
// try {
//   fs.writeFileSync('data/test.txt', 'Hello world synchronously')
// } catch (error) {
//   console.log(error)
// }

// menuliskan string ke file (asynchronously)
// fs.writeFile('data/test.txt', text, (err) => {
//   console.log(err)
// })

// console.log('Selesai')

// membaca isi file (sync)
// const data = fs.readFileSync('data/test.txt', 'utf-8')
// console.log(data)

// membaca isi file (async)
// fs.readFile('data/test.txt', 'utf-8', (err, data) => {
//   if (err) throw err
//   console.log(data)
// })

// readline
const readline = require('readline')

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout,
})

const saveToContacts = (answeredName, answeredPhone, data = '') => {
  const newData = data === '' ? [] : JSON.parse(data)

  const contacts = {
    nama: answeredName,
    phone: answeredPhone,
  }

  newData.push(contacts)

  fs.writeFile('data/contacts.json', JSON.stringify(newData), (err) => {
    console.log(err)
  })
}

rl.question('Siapa nama anda? ', (answeredName) => {
  rl.question('Berapa nomor hp anda? ', (answeredPhone) => {
    fs.readFile('data/contacts.json', 'utf-8', (err, data) => {
      if (err) {
        if (err.errno === -2) {
          saveToContacts(answeredName, answeredPhone)
        } else {
          throw err
        }
      }

      saveToContacts(answeredName, answeredPhone, data)
    })

    console.log(
      `Terimakasih ${answeredName}, berikut adalah nomor hp anda : ${answeredPhone}`
    )

    rl.close()
  })
})
