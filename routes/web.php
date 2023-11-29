<?php

use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisHambatanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PenasehatAkademikController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotifikasiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    //notifikasi
    Route::get('/notifikasi', 'HomeController@notifikasi')->name('notifikasi');
    Route::put('/read_notif/{id}', [NotifikasiController::class, 'read'])->name('read_notif');
    Route::put('/read_all/{id}', [NotifikasiController::class, 'read_all'])->name('read_all');
    // Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');
});
Route::middleware(['role:admin'])->group(function () {
    //akun
    Route::get('/users/admin', [UserController::class, 'admin'])->name('users.admin');
    Route::get('/users/dosen', [UserController::class, 'dosen'])->name('users.dosen');
    Route::get('/users/mahasiswa', [UserController::class, 'mahasiswa'])->name('users.mahasiswa');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    //layanan
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
    Route::post('/layanan/store', [LayananController::class, 'store'])->name('layanan.store');
    Route::put('/layanan/update/{id}', [LayananController::class, 'update'])->name('layanan.update');
    Route::delete('/layanan/destroy/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');
    //semester
    Route::get('/semester', [SemesterController::class, 'index'])->name('semester');
    Route::post('/semester/store', [SemesterController::class, 'store'])->name('semester.store');
    Route::put('/semester/update/{id}', [SemesterController::class, 'update'])->name('semester.update');
    Route::delete('/semester/destroy/{id}', [SemesterController::class, 'destroy'])->name('semester.destroy');
    //jenis_hambatan
    Route::get('/jenis_hambatan', [JenisHambatanController::class, 'index'])->name('jenis_hambatan');
    Route::post('/jenis_hambatan/store', [JenisHambatanController::class, 'store'])->name('jenis_hambatan.store');
    Route::put('/jenis_hambatan/update/{id}', [JenisHambatanController::class, 'update'])->name('jenis_hambatan.update');
    Route::delete('/jenis_hambatan/destroy/{id}', [JenisHambatanController::class, 'destroy'])->name('jenis_hambatan.destroy');
    //penasehat akademik
    Route::get('/penasehat_akademik', [PenasehatAkademikController::class, 'index'])->name('penasehat_akademik');
    Route::get('/penasehat_akademik/mahasiswa/{id}', [PenasehatAkademikController::class, 'mahasiswa'])->name('penasehat_akademik.mahasiswa');
    Route::post('/penasehat_akademik/store', [PenasehatAkademikController::class, 'store'])->name('penasehat_akademik.store');
    Route::put('/penasehat_akademik/update/{id}', [PenasehatAkademikController::class, 'update'])->name('penasehat_akademik.update');
    Route::delete('/penasehat_akademik/destroy/{id}', [PenasehatAkademikController::class, 'destroy'])->name('penasehat_akademik.destroy');
});
Route::middleware(['role:dosen'])->group(function () {
    //bimbingan
    Route::get('/bimbingan', [BimbinganController::class, 'index'])->name('bimbingan');
    Route::get('/bimbingan/riwayat/mahasiswa/{code}', [BimbinganController::class, 'riwayat_mahasiswa'])->name('bimbingan.riwayat.mahasiswa');
    Route::get('/bimbingan/mahasiswa/{id}', [BimbinganController::class, 'mahasiswa'])->name('bimbingan.mahasiswa');
    Route::post('/bimbingan/store_hasil', [BimbinganController::class, 'store_hasil'])->name('bimbingan.store_hasil');
});
Route::middleware(['role:dosen,mahasiswa'])->group(function () {
    //bimbingan
    Route::get('/bimbingan/riwayat', [BimbinganController::class, 'riwayat'])->name('bimbingan.riwayat');
    Route::get('/bimbingan', [BimbinganController::class, 'index'])->name('bimbingan');
    Route::get('/bimbingan/show/{id}', [BimbinganController::class, 'show'])->name('bimbingan.show');
    Route::post('/bimbingan/store', [BimbinganController::class, 'store'])->name('bimbingan.store');
});
Route::middleware(['role:mahasiswa'])->group(function () {
    //bimbingan
});
