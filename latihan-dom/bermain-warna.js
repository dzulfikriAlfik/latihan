const tUbahWarna = document.getElementById('tUbahWarna');

tUbahWarna.onclick = function () {
   // document.body.style.backgroundColor = 'lightblue';
   // document.body.setAttribute('class', 'biru-muda');
   document.body.classList.toggle('biru-muda');
}

// membuat selector baru Acak Warna di html
const tAcakWarna = document.createElement('button');
const teksTombol = document.createTextNode('Acak Warna');
tAcakWarna.appendChild(teksTombol);
tAcakWarna.setAttribute('type', 'button');
// penempatan selector baru
tUbahWarna.after(tAcakWarna);
tAcakWarna.addEventListener('click', function () {
   // math random warna
   const r = Math.round(Math.random() * 255 + 1);
   const g = Math.round(Math.random() * 255 + 1);
   const b = Math.round(Math.random() * 255 + 1);
   // masukan nilai math random warna ke dalam style
   document.body.style.backgroundColor = 'rgb(' + r + ',' + g + ', ' + b + ')';
   sRed.value = r;
   sGreen.value = g;
   sBlue.value = b;
});

// value html input range slider color
const sRed = document.querySelector('input[name=sRed]');
const sGreen = document.querySelector('input[name=sGreen]');
const sBlue = document.querySelector('input[name=sBlue]');

// membuat selector baru Reset Warna di html
const tResetWarna = document.createElement('button');
const teksTombolReset = document.createTextNode('Reset Warna');

tResetWarna.appendChild(teksTombolReset);
tResetWarna.setAttribute('type', 'button');
// penempatan selector baru
tUbahWarna.after(tResetWarna);
tResetWarna.addEventListener('click', function () {
   // ubah warna ke putih
   const r = 255;
   const g = 255;
   const b = 255;
   // reset warna ke putih
   document.body.style.backgroundColor = 'rgb(' + r + ',' + g + ', ' + b + ')';
   sRed.value = 128;
   sGreen.value = 128;
   sBlue.value = 128;
});

// mengubah style background dari value berdasarkan slider
// sRed.addEventListener('input', function () {
//    const r = sRed.value;
//    const g = sGreen.value;
//    const b = sBlue.value;
//    document.body.style.backgroundColor = 'rgb(' + r + ', ' + g + ', ' + b + ')';
// });
// sGreen.addEventListener('input', function () {
//    const r = sRed.value;
//    const g = sGreen.value;
//    const b = sBlue.value;
//    document.body.style.backgroundColor = 'rgb(' + r + ', ' + g + ', ' + b + ')';
// });
// sBlue.addEventListener('input', function () {
//    const r = sRed.value;
//    const g = sGreen.value;
//    const b = sBlue.value;
//    document.body.style.backgroundColor = 'rgb(' + r + ', ' + g + ', ' + b + ')';
// });

const warna = document.querySelectorAll("input[type='range']");
warna.forEach(function (slider) {
   slider.addEventListener("input", function () {
      const r = document.querySelector("input[name='sRed']").value;
      const g = document.querySelector("input[name='sGreen']").value;
      const b = document.querySelector("input[name='sBlue']").value;
      console.log(r, g, b);
      document.body.style.backgroundColor = `rgb(${r},${g},${b})`;
   })
})