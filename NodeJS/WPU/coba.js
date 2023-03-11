const sayHello = (nama, umur) => {
  return `Hi, nama saya ${nama}, saya berumur ${umur} tahun.`
}

const PI = 3.14

const mahasiswa = {
  nama: 'Doddy',
  umur: 29,
  cetakMhs() {
    return `Hi, nama saya ${this.nama}, saya berumur ${this.umur} tahun. Saya adalah seorang mahasiswa`
  },
}

class Person {
  constructor() {
    console.log('new Person has been instantiated')
  }
}

// module.exports.sayHello = sayHello
// module.exports.PI = PI

module.exports = {
  sayHello: sayHello,
  PI: PI,
  mahasiswa: mahasiswa,
  Person: Person,
}
