// function declaration
function jumlahVolumeDuaKubus(a, b) {
    var volumeA,
        volumeB,
        total;

    volumeA = a * a * a;
    volumeB = b * b * b;
    total = volumeA + volumeB;

    return total;
}

var lagi = true;
while (lagi) {

    a = parseInt(prompt('Masukan sisi kubus 1'));
    b = parseInt(prompt('Masukan sisi kubus 2'));
    alert('Jumlah Volume dari dua kubus adalah : ' + jumlahVolumeDuaKubus(a, b));
    console.log('Jumlah Volume dari dua kubus adalah : ' + jumlahVolumeDuaKubus(a, b));

    lagi = confirm('Lagi?');
}

// function expression
var tampilNama = function (nama) {
    console.log('halo ' + nama);
}

tampilNama('Dzulfikri');