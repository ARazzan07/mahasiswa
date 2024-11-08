<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cmahasiswa;
use App\Http\Controllers\Cfakultas;
use App\Http\Controllers\Clogin;
use App\Events\NamaEvent;

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
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/send-event', function () {
        event(new NamaEvent("Pesan dari server!"));
        return 'Event dikirim!';
    });
    Route::get('/login', [Clogin::class, 'index'])->name('login');
    Route::post('/login', [Clogin::class, 'login_proses'])->name('login_proses');
    Route::get('/home', function () {return view('welcome');})->name('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [Clogin::class, 'logout'])->name('logout');
    Route::get('/home1', function () {return view('welcome');})->name('home1');

    Route::get('/mahasiswa/export-pdf', [Cmahasiswa::class, 'exportPdf'])->name('mahasiswa.pdf');
    Route::get('/mahasiswa/export-excel', [Cmahasiswa::class, 'exportExcel'])->name('mahasiswa.excel');
    Route::get('/mahasiswa/maps', [Cmahasiswa::class, 'maps'])->name('maps');
    Route::get('/mapbox-routing', [Cmahasiswa::class, 'getRoute']);

    Route::resource('mahasiswa', Cmahasiswa::class);

    Route::get('/fakultas/export-pdf', [Cfakultas::class, 'exportPdfFakultas'])->name('fakultas.pdf');
    Route::get('/fakultas/export-excel', [Cfakultas::class, 'exportExcel'])->name('fakultas.excel');

    Route::resource('fakultas', Cfakultas::class);


});