// var angka = prompt('Masukan angka ');

// switch (angka) {
//     case '1':
//         alert('anda memasukkan angka 1');
//         break;
//     case '2':
//         alert('anda memasukkan angka 2');
//         break;
//     default:
//         alert('angka yang anda masukkan salah!');
//         break;
// }

var item = prompt('Masukan nama makanan / minuman \n contoh: nasi, daging, susu, hamburger, softdrink');

switch (item) {
    case 'nasi':
    case 'daging':
    case 'susu':
        alert('Makanan / minuman SEHAT!');
        break;
    case 'hamburger':
    case 'softdrink':
        alert('Makanan / minuman TIDAK SEHAT!');
        break;
    default:
        alert('Anda memasukan nama makanan / minuman yang salah!');
}