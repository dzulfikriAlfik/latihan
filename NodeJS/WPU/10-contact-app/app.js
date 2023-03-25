const { question, saveToContacts } = require('./contacts')

;(async () => {
  const name = await question('Siapa nama anda : ')
  const email = await question('Masukkan email anda : ')
  const mobilePhone = await question('Masukkan no hp anda : ')

  saveToContacts(name, email, mobilePhone)
})()
