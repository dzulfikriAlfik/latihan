// mengubah object menjadi JSON => JSON.stringify
// const mahasiswa = {
//    nama : "Dzulfikri",
//    npm : "14.14.1.0110",
//    email : "dzulfikri@gmail.com"
// }
// console.log(JSON.stringify(mahasiswa))


// ---------------------------------//
// mengubah JSON menjadi object => JSON.parse (menggunakan Ajax Vanilla JS)
// let xhr = new XMLHttpRequest();
// xhr.onreadystatechange = function () {
//    if (xhr.readyState == 4 && xhr.status == 200) {
//       let mahasiswa = JSON.parse(this.responseText);
//       console.log(mahasiswa);
//    }
// }

// xhr.open('GET', 'coba.json', true);
// xhr.send();


// -----------------------------------//
// mengubah JSON menjadi object => JSON.parse (menggunakan AJAx JQuery)
$.getJSON('coba.json', function (data) {
   console.log(data);
});