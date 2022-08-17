// Konsep this pada arrow function

// penting diketahui bahwa arrow function tidak memiliki konsep this
// reminder bentuk constructor function
// untuk membuat objek biasanya huruf pertama variable mrpkn huruf besar 
// tanpa menggunakan arrow function
// const Mahasiswa = function () {
//    this.nama = 'Dzulfikri';
//    this.umur = 24;
//    this.sayHello = function () {
//       console.log(`Hello nama saya ${this.nama}, dan saya berumur ${this.umur} tahun.`)
//    }
// }

// const dzulfikri = new Mahasiswa();

// dengan menggunakan arrow function tidak serta merta semua function bisa menggunakan arrow function khusus nya constructor function
// const Mahasiswa = function () {
//    this.nama = 'Dzulfikri';
//    this.umur = 24;
//    this.sayHello = () => {
//       console.log(`Hello nama saya ${this.nama}, dan saya berumur ${this.umur} tahun.`)
//    }
// }

// const dzulfikri = new Mahasiswa();
// console.log(dzulfikri.sayHello());

// ===========================================


// ===========================================
// akan berbeda kasusnya jika menggunakan object literal
// reminder object literal
const mhs1 = {
   nama: 'Dzulfikri',
   umur: 24,
   sayHello: function () {
      console.log(`Hello nama saya ${this.nama}, dan saya berumur ${this.umur} tahun.`);
   }
}

console.log(mhs1.sayHello());