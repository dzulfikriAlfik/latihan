// var lagi = true;

// while (lagi) {
//     var angka = prompt('Masukan Angka ');

//     if (angka % 2 === 0) {
//         alert(angka + ' adalah bilangan Genap');
//     } else if (angka % 2 === 1) {
//         alert(angka + ' adalah bilangan Ganjil');
//     } else {
//         alert('Yang anda masukan bukan merupakan angka');
//     }
//     lagi = confirm('Lagi?');
// }

// angkot 4
var jmlAngkot = 10,
    angkotBeroperasi = 6,
    angkotLembur = 8;

for (noAngkot = 1; noAngkot <= jmlAngkot; noAngkot++) {
    if (noAngkot <= angkotBeroperasi) {
        console.log('Angkot No. ' + noAngkot + ' beroperasi dengan baik.');
    } else if (noAngkot === angkotLembur) {
        console.log('Angkot No. ' + noAngkot + ' sedang lembur');
    } else {
        console.log('Angkot No. ' + noAngkot + ' sedang tidak beroperasi');
    }
}
console.log('\n');

// angkot 5
var jmlAngkot = 10,
    angkotBeroperasi = 6;

for (noAngkot = 1; noAngkot <= jmlAngkot; noAngkot++) {
    if (noAngkot <= angkotBeroperasi && noAngkot !== 5) {
        console.log('Angkot No. ' + noAngkot + ' beroperasi dengan baik.');
    } else if (noAngkot === 8 || noAngkot === 10 || noAngkot === 5) {
        console.log('Angkot No. ' + noAngkot + ' sedang lembur.');
    } else {
        console.log('Angkot No. ' + noAngkot + ' sedang tidak beroperasi.');
    }
}