<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HomePage
Route::get('/', 'SiteController@home');
Route::get('/about', 'SiteController@about');
// Registration
Route::get('/register', 'SiteController@register');
// Login
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
// logout
Route::get('/logout', 'AuthController@logout');
// Group Role Admin
Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    // siswa
    Route::get('/siswa', 'SiswaController@index');
    Route::post('/siswa/create', 'SiswaController@create');
    Route::get('/siswa/{siswa}/edit', 'SiswaController@edit');
    Route::post('/siswa/{siswa}/update', 'SiswaController@update');
    Route::get('/siswa/{siswa}/delete', 'SiswaController@delete');
    Route::get('/siswa/{siswa}/profile', 'SiswaController@profile');
    Route::post('/siswa/{siswa}/addnilai', 'SiswaController@addnilai');
    Route::get('/siswa/{siswa}/{mapel}/deletenilai', 'SiswaController@deletenilai');
    Route::get('/siswa/exportExcel', 'SiswaController@exportExcel');
    Route::get('/siswa/exportPdf', 'SiswaController@exportPdf');
    // Guru
    Route::get('/guru/{guru}/profile', 'GuruController@profile');
});
// Group Role Admin dan Siswa
Route::group(['middleware' => ['auth', 'checkRole:admin,siswa']], function () {
    // dashboard
    Route::get('/dashboard', 'DashboardController@index');
});
