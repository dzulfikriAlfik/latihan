// membuat object
// object literal
var mhs1 = {
    nama: "Dzulfikri",
    npm: "14.14.1.0110",
    email: "alfik@gmail.com",
    jurusan: "Teknik Informatika"
};
var mhs2 = {
    nama: "Ica Cahyani",
    npm: "14.14.1.0111",
    email: "ica@gmail.com",
    jurusan: "Teknik Mesin"
};

// function declaration
function buatObjectMahasiswa(nama, npm, email, jurusan) {
    var mhs = {};
    mhs.nama = nama;
    mhs.npm = npm;
    mhs.email = email;
    mhs.jurusan = jurusan;

    return mhs;
}
var mhs3 = buatObjectMahasiswa("Rini Oktaviani", "14.13.1.0098", "rini@gmail.com", "FAI");

// constructor
function Mahasiswa(nama, npm, email, jurusan) {
    this.nama = nama;
    this.npm = npm;
    this.email = email;
    this.jurusan = jurusan;
}
var mhs4 = new Mahasiswa("Rian Ramdhan", "14.15.1.0054", "rian@gmail.com", "Fapendasmen")