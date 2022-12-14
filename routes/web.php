<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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
    return view('welcome');
});

Route::get('/admin/login',[LoginController::class, 'login'])->name('login');
Route::post('/admin/postlogin',[LoginController::class, 'postlogin'])->name('postlogin');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin/dashboard',[HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
    Route::get('/admin/users',[UserController::class, 'users'])->name('users');
    Route::post('/admin/userlist',[UserController::class, 'getAllUsers'])->name('userlist');
    Route::get('/admin/users/edit/{id}',[UserController::class, 'editUser'])->name('edituser');
    Route::post('/admin/users/update/{id}',[UserController::class, 'updateUser'])->name('updateUser');
    Route::get('/admin/users/add',[UserController::class, 'addUser'])->name('addUser');
    Route::post('/admin/users/save',[UserController::class, 'saveUser'])->name('saveUser');


    Route::get('/admin/fooditems',[HomeController::class, 'foodItems'])->name('foodItems');
    Route::post('/admin/fooditemslist',[HomeController::class, 'getAllfooditems'])->name('getAllfooditems');
    Route::get('/admin/fooditems/add',[HomeController::class, 'addFooditems'])->name('addFooditems');
    Route::post('/admin/fooditems/save',[HomeController::class, 'saveFooditems'])->name('saveFooditems');
    Route::get('/admin/fooditems/edit/{id}',[HomeController::class, 'editFooditems'])->name('editFooditems');
    Route::post('/admin/fooditems/update/{id}',[HomeController::class, 'updateFooditems'])->name('updateFooditems');
    Route::post('/admin/fooditems/delete/{id}',[HomeController::class, 'deleteFooditems'])->name('deleteFooditems');
});