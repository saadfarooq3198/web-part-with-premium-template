<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth']);
Route::get('get_user', [UserController::class,'get_user']);
Route::get('get_users', [UserController::class,'get_users']);
Route::put('update_loggedin_user',[UserController::class,'update_loggedin_user']);
Route::resource('users',UserController::class);
Route::get('get_users', [UserController::class,'get_users']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
