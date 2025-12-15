<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeuzedeelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InschrijvingController;
use App\Http\Controllers\AdminController;

// Home pagina
Route::get('/', function () {
    return view('home');
});

// Keuzedelen bekijken (voor iedereen)
Route::get('/keuzedelen', [KeuzedeelController::class, 'index']);
Route::get('/keuzedelen/{id}', [KeuzedeelController::class, 'show']);

// Auth routes (voor gasten)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

// Routes voor ingelogde gebruikers
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/inschrijven/{keuzedeel_id}', [InschrijvingController::class, 'inschrijven']);
    Route::get('/mijn-inschrijvingen', [InschrijvingController::class, 'mijnInschrijvingen']);
});

// Admin routes (alleen voor admins)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/keuzedelen', [AdminController::class, 'keuzedelen']);
    Route::get('/keuzedelen/nieuw', [AdminController::class, 'createKeuzedeel']);
    Route::post('/keuzedelen', [AdminController::class, 'storeKeuzedeel']);
    Route::get('/keuzedelen/{id}/bewerk', [AdminController::class, 'editKeuzedeel']);
    Route::put('/keuzedelen/{id}', [AdminController::class, 'updateKeuzedeel']);
    Route::delete('/keuzedelen/{id}', [AdminController::class, 'deleteKeuzedeel']);
    Route::get('/inschrijvingen', [AdminController::class, 'inschrijvingen']);
});
