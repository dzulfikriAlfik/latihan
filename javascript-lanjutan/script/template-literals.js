// Tagged Templates
// const nama = 'Dzulfikri';
// const umur = 24;

// function coba(strings, ...values) {
//    // let result = '';
//    // strings.forEach((str, i) => {
//    //    result += `${str}${values[i] || ''}`;
//    // });
//    // return result;

//    return strings.reduce((result, str, i) => `${result}${str}${values[i] || ''}`, '');
// }

// const str = coba `Halo, nama saya ${nama}, saya berumur ${umur} tahun.`;
// console.log(str);

// ----------------------------------------------------------------
// Highlight
const nama = 'Dzulfikri';
const umur = 24;
const email = 'dzulfikrialfik@gmail.com';

function highlight(strings, ...values) {
   return strings.reduce((result, str, i) => `${result}${str}<span class="hl">${values[i] || ''}</span>`, '');
}

const str = highlight `Halo, nama saya ${nama}, saya berumur ${umur} tahun, email saya adalah ${email}`;

document.body.innerHTML = str;