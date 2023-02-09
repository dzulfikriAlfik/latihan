<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $input = 0;
        $input = "2";

        $result = match ($input) {
            0    => "hello",
            '1', '2', '3'      => "world",
        };

        $promotor      = new Promotor("Dzulfikri Alkautsari", 26);
        $namedArgument = $this->namedArguments(umur: 26, alamat: "Bandung", nama: "Dzulfikri");
        $promotor2     = new Promotor("Dzulfikri", 27, json_decode(json_encode(["alamat" => "Majalengka"])));

        $data = [
            "match"    => $result,
            "promotor" => [
                "nama" => $promotor->getNama(),
                "umur" => $promotor->getUmur()
            ],
            "named_args" => $namedArgument,
            "promotor2"  => $promotor2
        ];

        return view("index", $data);
    }

    public function namedArguments(string $nama, int $umur, string $alamat)
    {
        return "Nama saya $nama, umur saya $umur tahun, dan saya tinggal di $alamat";
    }
}

class Promotor
{
    public function __construct(private string $nama, private int $umur, private mixed $nullSafe = null)
    {
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function getUmur()
    {
        return $this->umur;
    }

    public function getNullSafe()
    {
        return $this->nullSafe ?: null;
    }
}
