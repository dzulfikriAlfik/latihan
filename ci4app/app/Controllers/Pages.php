<?php

namespace App\Controllers;

class Pages extends BaseController
{
	public function index()
	{
		$data = [
			'title'	=> 'Home | Web Programming Unpas'
		];
		return view('pages/home', $data);
	}

	//--------------------------------------------------------------------

	public function about()
	{
		$data = [
			'title'	=> 'About | Web Programming Unpas'
		];
		return view('pages/about', $data);
	}

	//--------------------------------------------------------------------

	public function contact()
	{
		$data = [
			'title'	=> 'Contact Us | Web Programming Unpas',
			'alamats'	=> [
				[
					'tipe'	=> 'Rumah',
					'alamat'	=> 'Jl. ABC No.1 Deca Kecamatan Kabupaten Provinsi Indonesia (123456)',
					'kota'	=> 'Bandung'
				],
				[
					'tipe'	=> 'Kantor',
					'alamat'	=> 'Jl. CBA No.31 Deca Kecamatan Kabupaten Provinsi Indonesia (654321)',
					'kota'	=> 'Jakarta'
				]
			]
		];
		return view('pages/contact', $data);
	}
}
