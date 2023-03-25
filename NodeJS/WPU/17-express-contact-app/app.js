const express = require('express')
const expressLayouts = require('express-ejs-layouts')
const app = express()
const port = 3000

// Gunakan EJS
app.set('view engine', 'ejs')

// # Third party middleware
app.use(expressLayouts)

// # Built in middleware
app.use(express.static('public'))

app.get('/', (req, res) => {
  const mahasiswa = [
    {
      nama: 'Dzulfikri Alkautsari',
      email: 'alfik@gmail.com',
    },
    {
      nama: 'Nirmala Sari',
      email: 'nirmala@gmail.com',
    },
    {
      nama: 'Sunyoto hanyakunyuk',
      email: 'sunyoto@gmail.com',
    },
  ]

  res.render('index', {
    layout: 'layouts/template',
    nama: 'Dzulfikri Alkautsari',
    title: 'Index',
    mahasiswa: mahasiswa,
  })
})

app.get('/about', (req, res) => {
  res.render('about', {
    layout: 'layouts/template',
    title: 'About',
  })
})

app.get('/contact', (req, res) => {
  res.render('contact', {
    layout: 'layouts/template',
    title: 'Contact',
  })
})

app.get('/product/:id', (req, res) => {
  res.render('product', {
    layout: 'layouts/template',
    title: 'Product',
    productId: req.params.id,
    category: req.query.category || 'All',
  })
})

app.use((req, res) => {
  res.status(404)
  res.render('404', {
    layout: 'layouts/template',
    title: '404',
  })
})

app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`)
})
