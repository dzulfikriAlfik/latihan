var ulangi = true;
while (ulangi) {
    // menangkap pilihan player
    var p = prompt('Silahkan pilih -> gajah | orang | semut');

    // menangkap pilihan computer secara randam
    var comp = Math.random();

    if (comp < 0.34) {
        comp = 'gajah';
    } else if (comp >= 0.34 && comp < 0.67) {
        comp = 'orang';
    } else {
        comp = 'semut';
    }

    // menentukan rules
    var hasil = '';

    if (p == comp) {
        hasil = 'SERI';
    } else if (p == 'gajah') {
        if (comp == 'orang') {
            hasil = 'MENANG';
        } else {
            hasil = 'KALAH';
        }
    } else if (p == 'orang') {
        hasil = (comp == 'gajah') ? 'KALAH' : 'MENANG';
    } else if (p == 'semut') {
        hasil = (comp == 'gajah') ? 'MENANG' : 'KALAH';
    } else {
        hasil = 'Memasukan pilihan yang salah';
    }

    // tampilkan hasil
    alert('Kamu memilih ' + p + ' dan komputer memilih ' + comp + '\nKAMU ' + hasil);
    ulangi = confirm('Mau main lagi?');
}

alert('Terima kasih sudah bermain');