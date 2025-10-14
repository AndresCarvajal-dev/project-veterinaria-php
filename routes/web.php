<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;

// Página de inicio: lista de productos
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::resource('productos', ProductController::class);
Route::get('productos/{producto}/pdf', [ProductController::class, 'showPdf'])->name('productos.pdf');

// Autenticación
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// CRUD de productos
Route::resource('productos', ProductController::class)->except(['show']);
