// menggunakan jquery
// $.ajax({
//    url: 'http://www.omdbapi.com/?apikey=bcd11129&s=avengers',
//    success: movies => console.log(movies)
// });

// ---------------------------------------------------
// vanilla javascript
// const xhr = new XMLHttpRequest();
// xhr.onreadystatechange = function () {
//    if (xhr.status === 200) {
//       if (xhr.readyState === 4) {
//          console.log(JSON.parse(xhr.response));
//       }
//    } else {
//       console.log(xhr.responseText);
//    }
// }
// xhr.open('get', 'http://www.omdbapi.com/?apikey=bcd11129&s=avengers');
// xhr.send();

// ----------------------------------------------------
// menggunakan fetch
// fetch('http://www.omdbapi.com/?apikey=bcd11129&s=avengers')
//    .then(response => response.json())
//    .then(response => console.log(response));

// -------------------------------------------------------
// Promise
// object yang merepresentasikan keberhasilan/kegagalan sebuah event yang asynchronus di masa datang
// janji (terpenuhi/ingkar)
// states (fulfilled/rejected/pending)
// callback (resolve/reject/finally)
// aksi (then / catch)

// Contoh promise Sederhana
let ditepati = true;
const janji1 = new Promise((resolve, reject) => {
   if (ditepati) {
      resolve("Janji telah ditepati");
   } else {
      reject("Ingkar Janji");
   }
});

janji1
   .then((response) => console.log("OK : " + response))
   .catch((response) => console.log("NOT OK : " + response));

console.log(janji1);
