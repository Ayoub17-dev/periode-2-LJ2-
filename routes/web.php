<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeuzedeelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InschrijvingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CsvImportController;
use App\Http\Controllers\MicrosoftAuthController;

// Home pagina
Route::get('/', function () {
    return view('home');
})->name('home');

// Keuzedelen 
Route::get('/keuzedelen', [KeuzedeelController::class, 'index'])->name('keuzedelen.index');
Route::get('/keuzedelen/{id}', [KeuzedeelController::class, 'show'])->name('keuzedelen.show');

// inlog routes/registreer routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    
    // Microsoft OAuth routes
    Route::get('/auth/microsoft', [MicrosoftAuthController::class, 'redirectToMicrosoft'])->name('microsoft.login');
    Route::get('/auth/microsoft/callback', [MicrosoftAuthController::class, 'handleMicrosoftCallback'])->name('microsoft.callback');
});

// Routes ingelogd 
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/inschrijven/{keuzedeel_id}', [InschrijvingController::class, 'inschrijven'])->name('inschrijvingen.create');
    Route::get('/mijn-inschrijvingen', [InschrijvingController::class, 'mijnInschrijvingen'])->name('inschrijvingen.index');
});

// Admin routes 
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/keuzedelen', [AdminController::class, 'keuzedelenIndex'])->name('admin.keuzedelen.index');
    Route::get('/admin/keuzedelen/nieuw', [AdminController::class, 'keuzedelenCreate'])->name('admin.keuzedelen.create');
    Route::post('/admin/keuzedelen', [AdminController::class, 'keuzedelenStore'])->name('admin.keuzedelen.store');
    Route::get('/admin/keuzedelen/{id}/edit', [AdminController::class, 'keuzedelenEdit'])->name('admin.keuzedelen.edit');
    Route::put('/admin/keuzedelen/{id}', [AdminController::class, 'keuzedelenUpdate'])->name('admin.keuzedelen.update');
    Route::put('/admin/keuzedelen/{id}/toggle', [AdminController::class, 'keuzedelenToggle'])->name('admin.keuzedelen.toggle');
    Route::get('/admin/inschrijvingen', [AdminController::class, 'inschrijvingenIndex'])->name('admin.inschrijvingen');
    
    // CSV Import routes
    Route::get('/admin/csv-import', [CsvImportController::class, 'index'])->name('admin.csv-import');
    Route::post('/admin/csv-import/upload', [CsvImportController::class, 'upload'])->name('admin.csv-import.upload');
    Route::delete('/admin/csv-import/delete-old', [CsvImportController::class, 'deleteOldInschrijvingen'])->name('admin.csv-import.delete');
});
