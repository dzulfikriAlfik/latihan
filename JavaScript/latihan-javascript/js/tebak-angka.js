alert('Selamat datang di game tebak angka \nTebak angka dan anda hanya memiliki 3 kesempatan');

var comp = Math.floor(Math.random() * 10) + 1;

for (var chance = 1; chance <= 3; chance++) {
    var p = prompt('Silahkan masukan angka'),
        sisa = 3;

    if (p == comp) {
        alert('Anda benar! \nangka yang dicari adalah ' + comp);
        chance = 4;
    } else if (p < comp) {
        sisa = 3 - chance;
        if (sisa == 0) {
            alert('Tebakan anda salah! angka yang dicari adalah ' + comp + ' \nKesempatan habis')
        } else {
            alert('Angka terlalu rendah! \nKamu memiliki ' + sisa + ' kesempatan');
        }
    } else if (p > comp) {
        sisa = 3 - chance;
        if (sisa == 0) {
            alert('Tebakan anda salah! komputer memilih ' + comp + ' \nKesempatan habis')
        } else {
            alert('Angka terlalu tinggi! \nKamu memiliki ' + sisa + ' kesempatan');
        }
    } else {
        alert('Angka yang anda masukan salah');
        chance = 4;
    }
}

alert('Terima kasih sudah bermain');