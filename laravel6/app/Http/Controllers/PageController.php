<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $tasks = [
            'Pergi Belajar',
            'Pergi Belanja',
            'Pergi Sekolah'
        ];

        return view('welcome')->with([
            'tasks' => $tasks,
            'foo' => 'bar'
        ]);
    }

    public function contact()
    {
        return view('contact');
    }
}
