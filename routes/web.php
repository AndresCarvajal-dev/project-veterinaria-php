<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AppointmentController;

// Página de inicio: login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('home');

// CRUD de productos
Route::get('/productos', [ProductController::class, 'index'])->name('productos.home');
Route::resource('productos', ProductController::class);
Route::get('productos/{producto}/pdf', [ProductController::class, 'showPdf'])->name('productos.pdf');

// Autenticación
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// CRUD de productos
Route::resource('productos', ProductController::class)->except(['show']);

// Dashboard y CRUD de citas veterinarias
Route::get('/dashboard', [AppointmentController::class, 'dashboard'])->name('dashboard');
Route::resource('appointments', AppointmentController::class);
Route::post('appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
Route::post('appointments/{appointment}/confirm', [AppointmentController::class, 'confirm'])->name('appointments.confirm');
Route::post('appointments/{appointment}/complete', [AppointmentController::class, 'complete'])->name('appointments.complete');

