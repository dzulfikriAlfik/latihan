const express = require('express')
const app = express()
const port = 3000

app.get('/', (req, res) => {
  // # Plaintext
  // res.send('Hello World!')

  // # JSON
  // res.json({
  //   status: 'OK',
  //   message: 'Data Found',
  //   data: {
  //     nama: 'Dzulfikri',
  //     address: 'Bandung, Indonesia',
  //     phone: '082121884879',
  //   },
  // })

  // # From file
  res.sendFile('./index.html', { root: __dirname })
})

app.get('/about', (req, res) => {
  res.sendFile('./about.html', { root: __dirname })
})

app.get('/contact', (req, res) => {
  res.sendFile('./contact.html', { root: __dirname })
})

app.get('/product/:id', (req, res) => {
  res.send(`Product ID : ${req.params.id}, Category : ${req.query.category}`)
})

app.use('/', (req, res) => {
  res.status(404)
  res.send('<h1>404</h1>')
})

app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`)
})
