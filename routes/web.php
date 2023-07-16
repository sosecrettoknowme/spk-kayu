<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\DataPenilaianController;
use App\Http\Controllers\DataPerhitunganContoller;
use App\Http\Controllers\DataController; // Tambahkan impor untuk DataController




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
    return view('home');
});

// RPUTE LOGIN
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


// REGISTER
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);


// Dahsboard
Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('auth'); 


Route::resource('/dashboard/kriteria', KriteriaController::class)->middleware('auth');

Route::resource('/dashboard/subkriteria', SubKriteriaController::class)->middleware('auth');
Route::post('/dashboard/kriteria/{id}/subkriteria', [SubKriteriaController::class, 'store'])->name('dashboard.subkriteria.store');
Route::get('/dashboard/kriteria/{id}/subkriteria/create', [SubKriteriaController::class, 'create'])->name('subkriteria.create');
Route::delete('/dashboard/subkriteria/{subKriteria}', [SubKriteriaController::class, 'destroy'])->name('subkriteria.destroy');

Route::resource('/dashboard/alternative', AlternativeController::class)->middleware('auth');


Route::resource('/dashboard/datapenilaian', DataPenilaianController::class)->middleware('auth');
Route::get('/dashboard/alternative/{id}/datapenilaian/create', [DataPenilaianController::class, 'create'])->name('datapenilaian.create');
Route::delete('/dashboard/datapenilaian/delete-all', [DataPenilaianController::class, 'destroy'])->name('datapenilaian.destroyAll');


// Route::post('/dashboard/alternative/{id}/datapenilaian', [DataPenilaianController::class, 'store'])->name('dashboard.datapenilaian.store');

Route::post('/dashboard/alternative/{id}/datapenilaian', [DataPenilaianController::class, 'store'])->name('dashboard.datapenilaian.store');

Route::resource('/dashboard/dataperhitungan', DataPerhitunganContoller::class)->middleware('auth');

Route::post('/data-perhitungan', [DataPerhitunganContoller::class, 'processData'])->name('data.process');
Route::get('/data', [DataPerhitunganContoller::class, 'index'])->name('data.index');
Route::get('/dashboard/dataperhitungan', [DataPerhitunganContoller::class, 'index'])->name('dashboard.dataperhitungan.index');

Route::get('/data-perhitungan/pdf', [DataPerhitunganContoller::class, 'generatePDF'])->name('dataPerhitungan.pdf');
