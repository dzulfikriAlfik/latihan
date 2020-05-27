// var str = '';
// for (var i = 0; i < 10; i++) {
//     for (var j = 0; j <= i; j++) {
//         str += '*';
//     }
//     str += '\n';
// }
// console.log(str);

var str = '';
for (var i = 10; i > 0; i--) {
    for (var j = 0; j < i; j++) {
        str += '*';
    }
    str += '\n';
}
console.log(str);
