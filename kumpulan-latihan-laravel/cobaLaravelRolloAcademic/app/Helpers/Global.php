<?php

use App\Siswa;
use App\Guru;

function ranking3Besar()
{
  $siswa = Siswa::all();
  $siswa->map(function ($student) {
    $student->raportnilai = $student->raportnilai();
    return $student;
  });
  $siswa = $siswa->sortByDesc('raportnilai')->take(3);
  return $siswa;
}

function totalSiswa()
{
  return Siswa::count();
}

function totalGuru()
{
  return Guru::count();
}
