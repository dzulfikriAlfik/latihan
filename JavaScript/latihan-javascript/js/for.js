// for (var nilaiAwal = 1; nilaiAwal <= 10; nilaiAwal++) {
//     console.log('Hello World ' + nilaiAwal + 'x');
// }

// Latihan angkot 2
var noAngkot = 1;
var angkotOperasi = 6;
var jmlAngkot = 10;

while (noAngkot <= angkotOperasi) {
    console.log('Angkot No. ' + noAngkot + ' beroperasi dengan baik');
    noAngkot++;
}
for (noAngkot = angkotOperasi + 1; noAngkot <= jmlAngkot; noAngkot++) {
    console.log('Angkot No. ' + noAngkot + ' sedang tidak beroperasi');
}