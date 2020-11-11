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

use App\Http\Controllers\SiswaController;

Route::get('/', 'SiteController@home');
Route::get('/register', 'SiteController@register');
Route::post('/postregister', 'SiteController@postregister');
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
    Route::post('/siswa/import', 'SiswaController@importExcel')->name('siswa.import');
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
    // Post
    Route::get('/posts', 'PostController@index')->name('posts.index');
    Route::get('/posts/add', [
        'uses' => 'PostController@add',
        'as'   => 'posts.add'
    ]);
    Route::post('/posts/create', [
        'uses' => 'PostController@create',
        'as'   => 'posts.create'
    ]);
    Route::get('/posts/{post}/delete', 'PostController@delete');
    Route::get('/posts/{post}/edit', 'PostController@edit');
    Route::get('/posts/{post}/update', 'PostController@update');
    // Route::get('/posts/{slug}/edit', [
    //     'uses' => 'PostController@edit',
    //     'as'   => 'post.single.edit'
    // ]);
    Route::get('/getdatasiswa', [
        'uses' => 'SiswaController@getdatasiswa',
        'as'   => 'ajax.get.data.siswa'
    ]);
});
// Group Hak Akses Siswa
Route::group(['middleware' => ['auth', 'checkRole:siswa']], function () {
    Route::get('profilsaya', 'SiswaController@profilsaya');
});
// Berita
Route::get('/{slug}', [
    'uses' => 'SiteController@singlepost',
    'as'   => 'site.single.post'
]);
