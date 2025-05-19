<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GemstoneController;
use Illuminate\Support\Facades\Route;

//Defining routes.
Route::get('/gemstones', [GemstoneController::class, 'index']);
Route::get('/gemstones/create', [GemstoneController::class, 'create'])->middleware(['auth', 'can:edit']);
Route::get('/gemstones/about', [GemstoneController::class, 'about']);
Route::post('/gemstones', [GemstoneController::class, 'store'])->middleware(['auth', 'can:edit']);
Route::get('/gemstones/{id}', [GemstoneController::class, 'show'])->middleware('auth');
Route::get('/gemstones/{id}/edit', [GemstoneController::class, 'edit'])->middleware(['auth', 'can:edit']);
Route::patch('/gemstones/{id}', [GemstoneController::class, 'update'])->middleware('auth');
Route::delete('/gemstones/{id}', [GemstoneController::class, 'destroy'])->middleware('auth');

Route::get('/grades', [GradeController::class, 'index']);

Route::get('/login', [AuthController::class, 'index'])->name("login");
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'registrationForm'])->name("register");
Route::post('/register', [AuthController::class, 'register']);


