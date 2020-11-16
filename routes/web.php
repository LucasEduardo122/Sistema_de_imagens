<?php

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

Route::get('/', ['App\Http\Controllers\HomeController', 'index'])->name('home');

Route::get('/home', ['App\Http\Controllers\HomeController', 'index'])->name('home');

Route::get('/login', ['App\Http\Controllers\Auth\AuthController', 'loginForm'])->name('login.form');
Route::post('/login/do', ['App\Http\Controllers\Auth\AuthController', 'autenticar'])->name('login.do');
Route::get('/logout', ['App\Http\Controllers\Auth\AuthController', 'logout'])->name('login.logout');

Route::get('/register', ['App\Http\Controllers\Register\RegisterController', 'registerForm'])->name('register.form');
Route::post('/register/storage', ['App\Http\Controllers\Register\RegisterController', 'register'])->name('register.storage');

Route::get('/espaco', ['App\Http\Controllers\UserController', 'index'])->name('user.index');
Route::post('/espaco/upload/storage', ['App\Http\Controllers\UserController', 'upload'])->name('user.upload');
Route::get('/perfil', ['App\Http\Controllers\UserController', 'perfil'])->name('user.perfil');