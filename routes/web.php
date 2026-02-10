<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostagemController;

Route::get('/', function () { return view('home'); });
Route::get('/home', function () { return view('home'); });

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/registrar', [LoginController::class, 'registrar'])->name('registrar');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/postagem', [PostagemController::class, 'store'])->name('postagem');
    Route::get('/postagem/{id}', [PostagemController::class, 'edit'])->name('postagem.edit');
});