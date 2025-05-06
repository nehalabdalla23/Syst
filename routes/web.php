<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NinjaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\modalscontroller;
use App\Http\Controllers\EmployeeController;
Route::get('/', [AuthController::class, 'showLogin'])->name('login.page');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/showUSERS', [AuthController::class, 'showUSERS'])->name('show.showUSERS');
Route::get('/searcch', [AuthController::class, 'searches'])->name('searcch');
// Modals
Route::get('/user{userid}', [modalscontroller::class,'users'])->name('user');

Route::get('/search', [modalscontroller::class,'search'])->name('search');

Route::get('/searches', [modalscontroller::class,'searches'])->name('searches');

// صفحة التعديل
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::get('/employees/add', [EmployeeController::class, 'Add'])->name('employees.add');
// حفظ التعديل
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
