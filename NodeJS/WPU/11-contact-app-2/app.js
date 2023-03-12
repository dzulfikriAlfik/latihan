const { saveToContacts, deleteContacts, showLists } = require('./contacts')
const yargs = require('yargs')

yargs
  .command({
    command: 'add',
    describe: 'Menambahkan contact baru',
    builder: {
      name: {
        describe: 'Nama lengkap',
        demandOption: true,
        type: 'string',
      },
      email: {
        describe: 'Email',
        demandOption: false,
        type: 'string',
      },
      phone: {
        describe: 'No. HP',
        demandOption: true,
        type: 'string',
      },
    },
    handler(argv) {
      saveToContacts(argv.name, argv.email, argv.phone)
    },
  })
  .demandCommand()

yargs
  .command({
    command: 'remove',
    describe: 'Menghapus contact berdasarkan nomor hp',
    builder: {
      name: {
        describe: 'Nama lengkap',
        demandOption: true,
        type: 'string',
      },
    },
    handler(argv) {
      deleteContacts(argv.name)
    },
  })
  .demandCommand()

yargs
  .command({
    command: 'list',
    describe: 'Menampilkan list kontak',
    handler(argv) {
      showLists()
    },
  })
  .demandCommand()

yargs.parse()
