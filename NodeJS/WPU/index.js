// const fs = require('fs') // core module

const { sayHello, PI, mahasiswa, Person } = require('./coba') // local module

// const moment = require('moment') // third party module / npm module (akan ada di folder node_modules)

/*
 * Konvensi urutan import / require biasanya
 * 1. core module
 * 2. local module
 * 3. third party module / npm module (akan ada di folder node_modules)
 */

const nama = 'Dzulfikri'
const umur = 27

console.log(sayHello(nama, umur))
console.log('PI is : ', PI)
console.log('Mahasiswa : ', mahasiswa.nama)
console.log('Cetak Mahasiswa : ', mahasiswa.cetakMhs())
console.log('Person Obj : ', new Person())
