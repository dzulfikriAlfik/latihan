// reminder bentuk function declaration
// function tampilPesan(nama) {
//     console.log(`Halo ${nama}`);
// }
// tampilPesan('Dzulfikri');

// reminder bentuk function expression
// let tampilPesan = function (nama) {
//     console.log(`Halo ${nama}`);
// }
// tampilPesan('Dzulfikri');
// function nya dimasukan dulu ke dalam variable
// =================================================


// =================================================
// DEFINISI ARROW FUNCTION
// 1. Bentuk lain yang lebih singkat dari function expression - MDN
// contoh :
// let tampilNama = nama => `Halo ${nama}`;
// console.log(tampilNama('Dzulfikri'))

// const tampilNama = (nama, waktu) => `Halo ${nama}, Selamat ${waktu}`;
// console.log(tampilNama('Dzulfikri', 'Malam'));
// jika parameter nya hanya satu maka tidak perlu dikasih kurung. function arrow bisa dijalankan tanpa dikasih return dan kurung kurawalnya, keadaan ini disebut dengan implisit return

// const tampilNama = () => `Hello World`;
// console.log(tampilNama());
// Jika function nya tidak memiliki parameter wajib memiliki kurung
// =================================================


// =================================================
// tanpa menggunakan arrow function
// let mahasiswa = ['Dzulfikri', 'Ica Cahyani', 'Dina Mawardani'];
// let jumlahHuruf = mahasiswa.map(function (nama){ 
//     return nama.length;
// });
// console.log(jumlahHuruf);

// dengan menggunakan arrow function
let mahasiswa = ['Dzulfikri', 'Ica Cahyani', 'Dina Mawardani'];
// let jumlahHuruf = mahasiswa.map(nama => nama.length);
// console.log(jumlahHuruf);

// jika ingin mengembalikan nya sebagai objek 
// supaya jadi objek kurung kurawalnya dibungkus dengan kurung biasa
let jumlahHuruf = mahasiswa.map(nama => ({
    nama, //nama: nama,
    jmlHuruf: nama.length
}));
console.table(jumlahHuruf);
// di javascript versi terbaru untuk mengembalikan nilai pada objek yang properti nya sama dengan nilainya cukup di tulis satu kali contoh -> {nama: nama} cukup ditulis {nama} saja
// =================================================