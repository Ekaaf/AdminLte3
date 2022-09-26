<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

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
    return view('welcome');
});

Route::get('/admin/login',[LoginController::class, 'login'])->name('login');
Route::post('/admin/postlogin',[LoginController::class, 'postlogin'])->name('postlogin');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin/dashboard',[HomeController::class, 'dashboard'])->name('dashboard');
});