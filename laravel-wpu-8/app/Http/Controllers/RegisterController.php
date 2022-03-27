<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'register'
        ];
        return view('register.index', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|max:50',
            'username' => ['required', 'min:5', 'max:50', 'unique:users'],
            'email'    => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:50'
        ]);

        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        // if ($validatedData) {
        //     User::create($validatedData);
        //     echo "<script>alert('Registrasi Berhasil');window.location.href='/login'</script>";
        // }
        User::create($validatedData);

        // $request->session()->flash('alert', 'You have successfully registered! Please Login!');

        return redirect('/login')->with('alert', 'You have successfully registered! Please Login!');
    }
}
