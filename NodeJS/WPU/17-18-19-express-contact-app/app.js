const express = require('express')
const expressLayouts = require('express-ejs-layouts')
const { check, body, validationResult } = require('express-validator')
const session = require('express-session')
const cookieParser = require('cookie-parser')
const flash = require('connect-flash')

const { loadContacts, findContact, addContact } = require('./utils/contact')

const app = express()
const port = 3000

// Gunakan EJS
app.set('view engine', 'ejs')

// # Third party middleware
app.use(expressLayouts)

// # Built in middleware
app.use(express.static('public'))
app.use(express.urlencoded({ extended: true }))

// # Konfigurasi flash
app.use(cookieParser('secret'))
app.use(
  session({
    cookie: {
      maxAge: 6000,
    },
    secret: 'secret',
    resave: true,
    saveUninitialized: true,
  })
)
app.use(flash())

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
  const contacts = loadContacts()

  res.render('contact', {
    layout: 'layouts/template',
    title: 'Contact',
    contacts,
    msg: req.flash('msg'),
  })
})

app.get('/contact/add', (req, res) => {
  res.render('contact-add', {
    layout: 'layouts/template',
    title: 'Add Contact',
  })
})

// Proccess save new contact
app.post(
  '/contact',
  [
    body('nama').custom((value, { req }) => {
      if (findContact(value)) {
        throw new Error('Nama sudah digunakan, silakan gunakan nama lain!')
      }

      return true
    }),
    check('email', 'Email tidak valid').isEmail(),
    check(
      'nohp',
      'No. HP tidak sesuai format Indonesia (628*****) || (08*****))'
    ).isMobilePhone('id-ID'),
  ],
  (req, res) => {
    const errors = validationResult(req)

    if (!errors.isEmpty()) {
      res.render('contact-add', {
        layout: 'layouts/template',
        title: 'Add Contact',
        errors: errors.array(),
      })
    } else {
      addContact(req.body)

      // Kirimkan flash message
      req.flash('msg', 'New contact added successfully!')

      res.redirect('/contact')
    }
  }
)

app.get('/contact/:nama', (req, res) => {
  const contact = findContact(req.params.nama)

  res.render('contact-detail', {
    layout: 'layouts/template',
    title: 'Detail Contact',
    contact,
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
