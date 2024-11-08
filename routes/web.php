<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cmahasiswa;
use App\Http\Controllers\Cfakultas;
use App\Http\Controllers\Clogin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['guest'])->group(function () {
    Route::get('/', [Clogin::class, 'index'])->name('login');
    Route::post('/', [Clogin::class, 'login_proses'])->name('login_proses');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [Clogin::class, 'logout'])->name('logout');
    Route::get('/home', function () {return view('welcome');})->name('home');

    Route::get('/mahasiswa/export-pdf', [Cmahasiswa::class, 'exportPdf'])->name('mahasiswa.pdf');
    Route::get('/mahasiswa/export-excel', [Cmahasiswa::class, 'exportExcel'])->name('mahasiswa.excel');

    Route::resource('mahasiswa', Cmahasiswa::class);

// Export routes for fakultas (PDF and Excel)
    Route::get('/fakultas/export-pdf', [Cfakultas::class, 'exportPdfFakultas'])->name('fakultas.pdf');
    Route::get('/fakultas/export-excel', [Cfakultas::class, 'exportExcel'])->name('fakultas.excel');

    Route::resource('fakultas', Cfakultas::class);


});