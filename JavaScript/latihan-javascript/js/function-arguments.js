function tambah() {
    var hasil = 0;

    for (var i = 0; i < arguments.length; i++) {
        hasil += arguments[i];
    }
    return hasil;
}

// var lagi = true;
// while (lagi) {
//     var angka = parseInt(prompt('Masukan angka : '));

//     lagi = confirm('Lagi ?');
// }

var hasil = (tambah(1,2,3,4));
console.log(hasil);