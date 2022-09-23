<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomRegisterController;

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

// Auth::routes();



Route::get('register',[CustomRegisterController::class,'registerFormShow'])->name('register');
Route::post('register',[CustomRegisterController::class,'registerUser'])->name('register.store');
Route::get('login',[CustomRegisterController::class,'loginShow'])->name('login');
Route::post('login',[CustomRegisterController::class,'loginUser'])->name('login.store');


Route::middleware(['auth'])->group(function(){
    Route::post('logout',[CustomRegisterController::class,'logout'])->name('logout');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


