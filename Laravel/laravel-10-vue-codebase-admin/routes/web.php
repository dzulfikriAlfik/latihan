<?php

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

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
Route::get("/test", function () {
    $permissions = Permission::pluck('name');

    foreach ($permissions as $permission) {
        $user = User::where("email", "alfik@gmail.com")->first();
        // $user = User::where("email", "editor@gmail.com")->first();

        $isRoleUserExist = $user->roles()->whereHas('permissions', function (Builder $q) use ($permission) {
            $q->where('name', $permission);
        })->exists();

        dump($permission, $isRoleUserExist);
    }
});

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
Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);

Route::view('/{any?}', 'dashboard')
    ->where('any', '.*');

