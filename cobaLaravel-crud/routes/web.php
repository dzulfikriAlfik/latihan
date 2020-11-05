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

// Homepage
Route::get('/', function () {
    return view('home');
});
// Login
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');
// Group Hak Akses Superadmin dan siswa
Route::group(['middleware' => ['auth', 'checkRole:superadmin,siswa']], function () {
    // Dashboard
    Route::get('/dashboard', 'DashboardController@index');
});
// Group Hak Akses Superadmin
Route::group(['middleware' => ['auth', 'checkRole:superadmin']], function () {
    // Siswa
    Route::get('/siswa', 'SiswaController@index');
    Route::post('/siswa/create', 'SiswaController@create');
    Route::get('/siswa/{siswa}/edit', 'SiswaController@edit');
    Route::post('/siswa/{siswa}/update', 'SiswaController@update');
    Route::get('/siswa/{id}/delete', 'SiswaController@delete');
    Route::get('/siswa/{siswa}/profile', 'SiswaController@profile');
    Route::post('/siswa/{siswa}/addnilai', 'SiswaController@addnilai');
    Route::get('/siswa/{siswa}/{idmapel}/deletenilai', 'SiswaController@deletenilai');
    Route::get('/siswa/exportExcel', 'SiswaController@exportExcel');
    Route::get('/siswa/exportPdf', 'SiswaController@exportPdf');
    // Guru
    Route::get('/guru', 'GuruController@index');
    Route::post('/guru/create', 'GuruController@create');
    Route::get('/guru/{guru}/profile', 'GuruController@profile');
    Route::get('/guru/{guru}/edit', 'GuruController@edit');
    Route::post('/guru/{guru}/update', 'GuruController@update');
    Route::get('/guru/{guru}/delete', 'GuruController@delete');
    Route::get('/guru/exportExcel', 'GuruController@exportExcel');
    Route::get('/guru/exportPdf', 'GuruController@exportPdf');
    // Mata Pelajaran
    Route::get('/mapel', 'MapelController@index');
    Route::post('/mapel/create', 'MapelController@create');
    Route::get('/mapel/{mapel}/edit', 'MapelController@edit');
    Route::post('/mapel/{mapel}/update', 'MapelController@update');
    Route::get('/mapel/{mapel}/delete', 'MapelController@delete');
    Route::get('/mapel/exportExcel', 'MapelController@exportExcel');
    Route::get('/mapel/exportPdf', 'MapelController@exportPdf');
});
