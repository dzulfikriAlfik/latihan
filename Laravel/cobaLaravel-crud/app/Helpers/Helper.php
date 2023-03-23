<?php

use App\Siswa;
use App\Guru;
use App\Mapel;

function getRanking5Besar()
{
  $siswa = Siswa::all();
  // variable siswa berarti banyak siswa, variable value berarti satu siswa 
  $siswa->map(function ($value) {
    $value->rataNilai = $value->rataNilai();
    return $value;
  });
  $siswa = $siswa->sortByDesc('rataNilai')->take(5);
  return $siswa;
}

function totalSiswa() {
  return Siswa::count();
}

function totalGuru() {
  return Guru::count();
}

function totalMapel() {
  return Mapel::count();
}