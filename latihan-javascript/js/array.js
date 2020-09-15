// var arr = ["Dzulfikri", "Ica Cahyani", "Rini oktaviani", "Rziky Pebriana"];

// for (var i = 0; i < arr.length; i++) {
//     console.log('Mahasiswa ke-' + (i+1) + ' : ' + arr[i]);
// }

// Method pada array
// var arr = ["Dzulfikri", "Ica Cahyani", "Rini oktaviani", "Rizky Pebriana"];
// 1. join (untuk memecah array menjadi string)
// console.log(arr.join(', '));

// 2. push & pop (push untuk menambah element terakhir pada array sedangkan pop untuk menghapus element terakhir pada array)
// arr.push('Doddy', 'Fitri');
// arr.pop();
// console.log(arr.join(', '));

// 3. unshift dan shift (unshift untuk menambah element pertama pada array sedangkan shift untuk menghapus element pertama pada array)
// arr.unshift('Doddy');
// arr.shift();
// console.log(arr.join(', '));

// 4. splice (untuk menambah elemen di tengah  array bisa juga menghapus beberapa elemen setelah index awal penambahan elemen )
// syntax splice -> splice(indexAwal, mauDihapusBerapa, elemenBaru1, elemenBaru2, elemenBaru...)
// arr.splice(2, 0, 'Doddy', 'Fitri');
// arr.splice(2, 1, 'Doddy', 'Fitri');
// console.log(arr.join(', '));

// 5. slice (untuk mengambil beberapa elemen di tengah)
// syntax slice -> slice(awal,akhir) -> index akhir tidak akan terambil, yg terambil hanya index antara awal dan akhir
// var arr2 = arr.slice(1, 3);
// console.log(arr2.join(', '));

// 6. forEach
var angka = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
var nama = ["Dzulfikri", "Ica Cahyani", "Rini oktaviani", "Rizky Pebriana"];
// for (var i = 0; i < angka.length; i++) {
//     console.log(angka[i]);
// }
// angka.forEach(function(e) {
//     console.log(e);
// });

// bisa juga dilakukan dengan cara function expression
// var cetak = function (e) {
//     console.log(e);
// }
// angka.forEach(cetak);
// nama.forEach(function (e, i) {
//     console.log('Mahasiswa ke-' + (i+1) + ' : ' + e);
// });

// 7. map (perulangan yang bisa mengembalikan nilai pada array)
// var angka = [1, 2, 5, 3, 8, 4, 9];
// var angka2 = angka.map(function (e) {
//     return e * 2;
// });

// console.log(angka2.join(', '));

// 8. sort (untuk mengurutkan array dari data yg acak)
// var angka = [1, 10, 2, 5, 3, 20, 8, 4, 9];
// console.log(angka.join(', '));
// angka.sort();
// console.log(angka.join(', '));

// angka.sort(function (a, b) {
//     return a - b;
// })
// console.log(angka.join(', '));

// 9. filter & find (untuk mencari nilai pada array dan mengembalikannya menjadi banyak nilai tidak sepert find yang hanya bisa satu )
var angka = [1, 10, 2, 5, 3, 20, 8, 4, 9];
var angka2 = angka.find(function (e) {
    return e > 5;
});
console.log(angka2);
