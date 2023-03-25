function cetakAngka(n) {
    if ( n === 0) {
        return;
    }
    console.log(n);
    cetakAngka(n - 1);
}

cetakAngka(10);

console.log('\nProgram hitung faktorial')

function hitungFaktorial(n) {
    if (n === 0) return 1;
    return n * hitungFaktorial(n - 1);
}

console.log(hitungFaktorial(5));