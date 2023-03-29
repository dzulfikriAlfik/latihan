const express = require('express')
const expressLayouts = require('express-ejs-layouts')
const { check, body, validationResult } = require('express-validator')
const session = require('express-session')
const cookieParser = require('cookie-parser')
const flash = require('connect-flash')

const {
  loadContacts,
  findContact,
  addContact,
  updateContact,
  deleteContact,
} = require('./utils/contact')

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
  const students = [
    {
      name: 'Dzulfikri Alkautsari',
      email: 'alfik@gmail.com',
    },
    {
      name: 'Nirmala Sari',
      email: 'nirmala@gmail.com',
    },
    {
      name: 'Sunyoto hanyakunyuk',
      email: 'sunyoto@gmail.com',
    },
  ]

  res.render('index', {
    layout: 'layouts/template',
    name: 'Dzulfikri Alkautsari',
    title: 'Index',
    students,
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

app.get('/contact/edit/:name', (req, res) => {
  const contact = findContact(req.params.name)

  if (!contact) {
    res.status(404)
    res.render('404', {
      layout: 'layouts/template',
      title: '404',
    })
    return
  }

  res.render('contact-edit', {
    layout: 'layouts/template',
    title: 'Edit Contact',
    contact,
  })
})

// Proccess save new contact
app.post(
  '/contact',
  [
    body('name').custom((value, { req }) => {
      if (findContact(value)) {
        throw new Error('Name is taken. Please use different name!')
      }

      return true
    }),
    check('email', 'Email is invalid').isEmail(),
    check(
      'phone',
      'Mobile phone is not Indonesian formatted (628*****) || (08*****))'
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

// Proccess update contact
app.post(
  '/contact/update',
  [
    body('name').custom((value, { req }) => {
      const contact = findContact(value)

      if (contact && contact.name !== req.body.oldName) {
        throw new Error('Name is taken. Please use different name!')
      }

      return true
    }),
    check('email', 'Email is invalid').isEmail(),
    check(
      'phone',
      'Mobile phone is not Indonesian formatted (628*****) || (08*****))'
    ).isMobilePhone('id-ID'),
  ],
  (req, res) => {
    const errors = validationResult(req)

    if (!errors.isEmpty()) {
      res.render('contact-edit', {
        layout: 'layouts/template',
        title: 'Edit Contact',
        errors: errors.array(),
        contact: req.body,
      })
    } else {
      updateContact(req.body)

      // Kirimkan flash message
      req.flash('msg', 'Contact updated successfully!')

      res.redirect('/contact')
    }
  }
)

app.get('/contact/delete/:name', (req, res) => {
  const contact = findContact(req.params.name)

  if (!contact) {
    res.status(404)
    res.render('404', {
      layout: 'layouts/template',
      title: '404',
    })
    return
  }

  deleteContact(req.params.name)

  // Kirimkan flash message
  req.flash('msg', 'Contact deleted successfully!')

  res.redirect('/contact')
})

app.get('/contact/:name', (req, res) => {
  const contact = findContact(req.params.name)

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
