<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Siswa;
use App\Post;

class SiteController extends Controller
{
    public function home()
    {
        return view('site.home');
    }

    public function register()
    {
        return view('site.register');
    }

    public function postregister(Request $request)
    {
        $user                 = new User;
        $user->role           = 'siswa';
        $user->name           = $request->nama_depan . ' ' . $request->nama_belakang;
        $user->email          = $request->email;
        $user->password       = bcrypt($request->password);
        $user->remember_token = str_random(60);
        $user->save();
        // Insert ke Table Siswa
        $request->request->add(['user_id' => $user->id]);
        Siswa::create($request->all());
        return redirect('/')->with('success', 'Data Pendaftaran Berhasil Dikirim, Terima Kasih Telah Mendaftar');
    }

    public function singlepost($slug)
    {
        $post = Post::where('slug', '=', $slug)->first();
        return view('site.singlepost', compact('post'));
    }
}
