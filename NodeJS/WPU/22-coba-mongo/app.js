const { MongoClient, ObjectID } = require('mongodb')

// Connection URL
const url = 'mongodb://127.0.0.1:27017'

// Database Name
const dbName = 'wpu'
const client = new MongoClient(url, {
  // useNewUrlParser: true,
  // useUnifiedTopology: true,
})
// Use connect method to connect to the server
client.connect(function (err, clt) {
  if (err) {
    return console.log('Failed to connect to server!')
  }

  console.log('Connected successfully to server')

  // Choose database
  const db = client.db(dbName)

  // add new document
  /* db.collection('mahasiswa').insertOne(
    {
      nama: 'Doddy',
      email: 'doddy@gmail.com',
      phone: '082112341234',
    },
    (error, result) => {
      if (error) return console.log('Data failed to insert')

      console.log(result)
    }
  ) */

  // Add new document (many)
  /* db.collection('mahasiswa').insertMany(
    [
      {
        nama: 'Erik',
        email: 'erik@yahoo.com',
        phone: '082112341234',
      },
      {
        nama: 'Avip',
        email: 'avip@yahoo.com',
        phone: '082112341234',
      },
    ],
    (error, result) => {
      if (error) return console.log('Data failed to insert')

      console.log(result)
    }
  ) */

  // Read all document
  /* console.log(
    db
      .collection('mahasiswa')
      .find()
      .toArray((error, result) => {
        console.log(result)
      })
  ) */

  // Read all document with conditioning
  /* console.log(
    db
      .collection('mahasiswa')
      .find({ _id: ObjectID('6427cdcb70238fc5c7bcbfa5') })
      .toArray((error, result) => {
        console.log(result)
      })
  ) */

  // Update one document based on criteria
  /* const updatePromise = db.collection('mahasiswa').updateOne(
    { _id: ObjectID('6427cdcb70238fc5c7bcbfa5') },
    {
      $set: {
        nama: 'Avip Saifulloh',
      },
    }
  )
  updatePromise.then((result) => console.log(result)) */

  // Update one document based on criteria
  /* const updatePromise = db.collection('mahasiswa').updateMany(
    { nama: 'Erik' },
    {
      $set: {
        nama: 'Erik doank',
      },
    }
  )
  updatePromise.then((result) => console.log(result)) */

  // delete one document based on criteria
  /* db.collection('mahasiswa')
    .deleteOne({ _id: ObjectID('6427cdcb70238fc5c7bcbfa5') })
    .then((result) => console.log(result)) */

  // delete many document based on criteria
  db.collection('mahasiswa')
    .deleteMany({ nama: 'Doddy' })
    .then((result) => console.log(result))

  client.close()
})
