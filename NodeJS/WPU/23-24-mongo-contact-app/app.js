const express = require('express')
const expressLayouts = require('express-ejs-layouts')

const { check, body, validationResult } = require('express-validator')
const methodOverride = require('method-override')

const session = require('express-session')
const cookieParser = require('cookie-parser')
const flash = require('connect-flash')

require('./utils/db')
const Contact = require('./model/contact')

const app = express()
const port = 3000

// Setup methodOverride
app.use(methodOverride('_method'))

// Gunakan EJS
app.set('view engine', 'ejs')
app.use(expressLayouts)
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

app.get('/contact', async (req, res) => {
  const contacts = await Contact.find()

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
    body('name').custom(async (value, { req }) => {
      if (await Contact.findOne({ name: value })) {
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
      Contact.insertMany(req.body, (error, result) => {
        // Kirimkan flash message
        req.flash('msg', 'New contact added successfully!')

        res.redirect('/contact')
      })
    }
  }
)

app.get('/contact/edit/:name', async (req, res) => {
  const contact = await Contact.findOne({ name: req.params.name })

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

// Proccess update contact
app.put(
  '/contact',
  [
    body('name').custom(async (value, { req }) => {
      const contact = await Contact.findOne({ name: value })

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
      Contact.updateOne(
        { _id: req.body._id },
        {
          $set: {
            name: req.body.name,
            phone: req.body.phone,
            email: req.body.email,
          },
        }
      ).then((result) => {
        // Kirimkan flash message
        req.flash('msg', 'Contact updated successfully!')

        res.redirect('/contact')
      })
    }
  }
)

app.delete('/contact', (req, res) => {
  Contact.deleteOne({ _id: req.body._id }, (error, result) => {
    // Kirimkan flash message
    req.flash('msg', 'Contact deleted successfully!')

    res.redirect('/contact')
  })
})

app.get('/contact/:name', async (req, res) => {
  const contact = await Contact.findOne({ name: req.params.name })

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
  console.log(`Mongo contact app | listening at http://localhost:${port}`)
})
