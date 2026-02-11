<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostagemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfessorController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']); 
Route::get('/home/{id}', [HomeController::class, 'show'])->name('home.get'); 

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/registrar', [LoginController::class, 'registrar'])->name('registrar');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/postagem', [PostagemController::class, 'store'])->name('postagem');
    Route::get('/postagem/{id}', [PostagemController::class, 'edit'])->name('postagem.edit');
    Route::get('/postagem/{id}', [PostagemController::class, 'validar'])->name('postagem.validar');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/professor', [ProfessorController::class, 'index'])->name('professor.dashboard');
});