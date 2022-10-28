<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AuthController::class, 'showLogin'])->name('login')->middleware('guest:admin');
Route::name('admin.')->group(
    function () {
        Route::post('/login', [AuthController::class, 'Login'])->name('login');
        Route::get('/logout', [AuthController::class, 'Logout'])->name('logout');
});

Route::group(["middleware" => ["auth:admin"]], function(){
     Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
     Route::post('/post/upload', [PostController::class,'ckupload'])->name('ckeditor.upload');
     //Route::resource('/post', PostController::class);
     Route::resources([
        '/post' => PostController::class,
        '/event' => EventController::class,
     ]);
});


