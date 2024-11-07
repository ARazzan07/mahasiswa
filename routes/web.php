<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cmahasiswa;
use App\Http\Controllers\Cfakultas;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('mahasiswa', Cmahasiswa::class);

Route::resource('fakultas', Cfakultas::class);
