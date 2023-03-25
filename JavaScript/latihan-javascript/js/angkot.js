var penumpang = [];

var tambahPenumpang = function (namaPenumpang, penumpang) {
    // jika angkot kosong
    if (penumpang.length == 0) {
        // tambah penumpang di awal array
        penumpang.push(namaPenumpang);
        // kembalikan isi array & keluar dari function
        return penumpang;
    } else {
        // telusuri seluruh kursi dari awal
        for (var i = 0; i < penumpang.length; i++) {
            // jika ada kursi kosong
            if (penumpang[i] == undefined) {
                // tambah penumpang dikursi tsb
                penumpang[i] = namaPenumpang;
                // kembalikan isi array dan keluar dari function
                return penumpang;
            }
            // jika sudah ada nama yang sama
            else if (penumpang[i] == namaPenumpang) {
                // tampilkan pesan kesalahan
                console.log(namaPenumpang + ' sudah ada didalam angkot');
                // kembalikan isi array dan keluar dari function
                return penumpang;
            }
            // jika seluruh kursi terisi
            else if (i == penumpang.length - 1) {
                // tambahPenumpang di akhir array
                penumpang.push(namaPenumpang);
                // kembalikan isi array dan keluar dari function
                return penumpang;
            }
        }
    }
}

var hapusPenumpang = function (namaPenumpang, penumpang) {
    // jika angkot kosong
    if (penumpang.length == 0) {
        // tampilkan pesan bahwa angkot masih kosong
        console.log('Penumpang masih kosong !');
        // kembalikan isi array dan keluar dari function
        return penumpang;
    }
    // else
    else {
        // terlusuri seluruh kursi dari awal
        for (var i = 0; i < penumpang.length; i++) {
            // jika ada penumpang yg sesuai
            if (penumpang[i] == namaPenumpang) {
                // hapus penumpang dengan mengubah namanya menjadi undefined
                penumpang[i] = undefined;
                // kembalikan isi array dan keluar dari function
                return penumpang;
            }
            // jika tidak ada nama yg sesuai
            else if (i == penumpang.length - 1) {
                // tampilkan pesan kesalahannya
                console.log('tidak ada penumpang bernama ' + namaPenumpang);
                // kembalikan isi array dan keluar dari function
                return penumpang;
            }
        }
    }
}