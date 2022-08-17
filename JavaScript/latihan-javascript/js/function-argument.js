function tambah(a, b) {
    hasil = a + b;
    return hasil;
}

function kali(a, b) {
    hasil = a * b;
    return hasil;
}

var hasil = kali(tambah(1, 2), tambah(3, 4));
console.log(hasil);