<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cmahasiswa;
use App\Http\Controllers\Cfakultas;
use App\Http\Controllers\Clogin;
use App\Http\Controllers\SocialiteController;

Route::middleware(['guest'])->group(function () {
    // Main page for guests (before login)
    Route::get('/', function () {
        return view('welcome');
    });

    // Google login routes
    Route::controller(SocialiteController::class)->group(function () {
        Route::get('auth/google', 'googleLogin')->name('auth.google');
        Route::get('auth/google-callback', 'googleAuthentication')->name('auth.google-callback');
    });

    // Traditional login page
    Route::get('/login', [Clogin::class, 'index'])->name('login');
    Route::post('/login', [Clogin::class, 'login_proses'])->name('login_proses');
    
    // Home page for guests (before login)
    Route::get('/home', function () {
        if (Auth::check()) {
            return redirect()->route('home1');  // Redirect authenticated users
        }
        return view('welcome');  // Show home for guests
    })->name('home');
});

Route::middleware(['auth'])->group(function () {
    // Logout route
    Route::get('/logout', [Clogin::class, 'logout'])->name('logout');

    // Home page for authenticated users
    Route::get('/home1', function () {
        return view('welcome');  // Replace this with the appropriate view for logged-in users
    })->name('home1');

    // Routes for mahasiswa and fakultas
    Route::get('/mahasiswa/export-pdf', [Cmahasiswa::class, 'exportPdf'])->name('mahasiswa.pdf');
    Route::get('/mahasiswa/export-excel', [Cmahasiswa::class, 'exportExcel'])->name('mahasiswa.excel');
    Route::get('/mahasiswa/maps', [Cmahasiswa::class, 'maps'])->name('maps');
    Route::get('/mapbox-routing', [Cmahasiswa::class, 'getRoute']);

    Route::resource('mahasiswa', Cmahasiswa::class);

    Route::get('/fakultas/export-pdf', [Cfakultas::class, 'exportPdfFakultas'])->name('fakultas.pdf');
    Route::get('/fakultas/export-excel', [Cfakultas::class, 'exportExcel'])->name('fakultas.excel');
    Route::resource('fakultas', Cfakultas::class);
});
