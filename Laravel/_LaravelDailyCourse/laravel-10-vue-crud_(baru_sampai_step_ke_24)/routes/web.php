<?php

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/n', function () {
    DB::enableQueryLog();

    $posts = Post::with("category")->get();

    dump($posts->toArray());

    foreach($posts as $post) {
        $category = $post->category;

        dump($category->toArray());
    }

    dump(DB::getQueryLog());
});

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::view('/{any?}', 'dashboard')
    ->where('any', '.*');

