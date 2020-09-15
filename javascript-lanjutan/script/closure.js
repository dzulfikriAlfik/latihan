// DEFINISI CLOSURE
// 1. Closure merupakan kombinasi antara function dan lingkungan leksikal (leksikal scope) didalam function tersebut - MDN (Mozilla)
// 2. Closure adalah sebuah function ketika memiliki akses ke parent scope-nya, meskipun parent scope-nya sudah selesai di eksekusi - W3School
// 3. Closure adalah sebuah function yang dikembalikan oleh function yang lain, yang memiliki akses ke lingkungan saat ia diciptakan - code fellow
// 4. Closure adalah sebuah function yang sebelumnya sudah meiliki data yang merupakan hasil dari function yang lain - Techsith
// =================================================



// =================================================
// LEXICAL SCOPE adalah ketika sebuah variable didalam sebuah function atau memiliki akses untuk menggunakan variable diluar function tersebut. inner function yang menggunakan variable diluarnya maka keadaan itu bisa disebut dengan closure
// =================================================



// =================================================
// function init() {
//     // let nama = 'Dzulfikri';

//     function tampilNama(nama) {
//         console.log(nama);
//     }
//     //console.dir(tampilNama); //menampilkan objek function tampilNama

//     //tampilNama(); //termasuk kedalam inner function atau function didalam function
//     return tampilNama;
// }

// //init();

// //ketika function tampilNama di return tapi tidak menjalankan functionnya, maka bisa dimasukan kedalam variable baru yang menjalankan function parent nya dan variable tsb dipanggil seolah2 function baru
// // let panggilNama = init();
// // panggilNama();

// // atau bisa juga dengan cara function tampilNama nya diisi dengan parameter lalu nilainya dimasukan saat menjalankan function panggilNama
// let panggilNama = init();
// panggilNama('Dzulfikri');

// function init() {
//     return function (nama) { //function anonymous
//         console.log(nama);
//     }
// }

// let panggilNama = init();

// panggilNama('Dzulfikri');
// =================================================



// =================================================
// Kenapa menggunakan Closure?
// - untuk membuat function factories
// - untuk membuat private method

// function ucapkanSalam(waktu) {
//   return function (nama) {
//     console.log(`Halo ${nama}, Selamat ${waktu}, Semoga harimu menyenangkan`);
//   }
// }

// let selamatPagi = ucapkanSalam('Pagi');
// let selamatSiang = ucapkanSalam('Siang');
// let selamatMalam = ucapkanSalam('Malam');

// selamatPagi('Dzulfikri');
// selamatMalam('Alkautsari');
// =================================================



// =================================================
// cara tanpa closure
// let counter = 0;
// let add = function () {
//   return ++counter;
// }

// console.log(add());
// console.log(add());
// console.log(add());

// dengan closure
// let add = function () {
//   let counter = 0;
//   return function () {
//     return ++counter;
//   }
// }

// let a = add();

// console.log(add());
// console.log(add());
// console.log(add());

// counter nya tidak bisa diakses dari luar, tapi masih bisa difungsikan dengan baik oleh closurenya

// ada cara yang lebih efektif dengan teknik IIFE (Immediately Invoke Function Expression) caranya adalah masukan isi function utamanya kedalam kurung lalu function nya dijalankan
let add = (function () {
  let counter = 0;
  return function () {
    return ++counter;
  }
})();

console.log(add());
console.log(add());
console.log(add());
// =================================================