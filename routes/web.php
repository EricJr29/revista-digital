<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostagemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\SeguidoresController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/{id}', [HomeController::class, 'show'])->name('home.get');
Route::get('/home/visualizar/{id}', [HomeController::class, 'visualizar'])->name('postagem.visualizar');
Route::get('/perfil/visualizar/{id}', [ProfileController::class, 'visualizar'])->name('profile.visualizar');
Route::get('/pesquisa', [HomeController::class, 'pesquisa'])->name('pesquisa');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/registrar', [LoginController::class, 'registrar'])->name('registrar');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile');
    Route::get('/amigos', [SeguidoresController::class, 'index'])->name('amigos');
    Route::get('/amigos/del/{id}', [SeguidoresController::class, 'destroy'])->name('delete.amigo');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/postagem', [PostagemController::class, 'store'])->name('postagem');
    Route::get('/postagem/editar/{id}', [PostagemController::class, 'edit'])->name('postagem.edit');
    Route::get('/postagem/validar/{id}', [PostagemController::class, 'validar'])->name('postagem.validar');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/professor', [ProfessorController::class, 'index'])->name('professor.dashboard');
});
