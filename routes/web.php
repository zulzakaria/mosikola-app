<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\TendikController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\JurnalTendikController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\LoginTendikController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\JamPelajaranController;
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

Route::get('/', [MainController::class, 'index'])->name('main.index');
Route::get('/tendik', [MainController::class, 'tendik'])->name('main.tendik');
Route::get('/detil/{id}',[MainController::class,'detil'])->name('main.detil');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah.index');
    Route::post('/sekolah/update', [SekolahController::class, 'update'])->name('sekolah.update');
    Route::get('/kontrol', [SekolahController::class, 'kontrol'])->name('kontrol');
    Route::post('/kontrol/update', [SekolahController::class, 'updateKontrol'])->name('kontrol.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/guru/store', [GuruController::class, 'store'])->name('guru.store');
    Route::post('/guru/nonAktifkan', [GuruController::class, 'nonAktifkan'])->name('guru.nonAktifkan');
    Route::post('/guru/aktifkan', [GuruController::class, 'aktifkan'])->name('guru.aktifkan');
    Route::post('/guru/resetPassword', [GuruController::class, 'resetPassword'])->name('guru.resetPassword');

    Route::get('/tendik/index', [TendikController::class, 'index'])->name('tendik.index');
    Route::get('/tendik/create', [TendikController::class, 'create'])->name('tendik.create');
    Route::post('/tendik/store', [TendikController::class, 'store'])->name('tendik.store');
    Route::post('/tendik/nonAktifkan', [TendikController::class, 'nonAktifkan'])->name('tendik.nonAktifkan');
    Route::post('/tendik/aktifkan', [TendikController::class, 'aktifkan'])->name('tendik.aktifkan');
    Route::post('/tendik/resetPassword', [TendikController::class, 'resetPassword'])->name('tendik.resetPassword');

    Route::get('/mapel', [MapelController::class, 'index'])->name('mapel.index');
    Route::get('/mapel/create', [MapelController::class, 'create'])->name('mapel.create');
    Route::post('/mapel/store', [MapelController::class, 'store'])->name('mapel.store');
    Route::get('/mapel/edit/{id}', [MapelController::class, 'edit'])->name('mapel.edit');
    Route::post('/mapel/update', [MapelController::class, 'update'])->name('mapel.update');

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/edit/{id}', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::post('/kelas/update', [KelasController::class, 'update'])->name('kelas.update');

    Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi.index');
    Route::get('/lokasi/create', [LokasiController::class, 'create'])->name('lokasi.create');
    Route::post('/lokasi/store', [LokasiController::class, 'store'])->name('lokasi.store');
    Route::get('/lokasi/edit/{id}', [LokasiController::class, 'edit'])->name('lokasi.edit');
    Route::post('/lokasi/update', [LokasiController::class, 'update'])->name('lokasi.update');

    Route::get('/periode', [PeriodeController::class, 'index'])->name('periode.index');
    Route::get('/periode/create', [PeriodeController::class, 'create'])->name('periode.create');
    Route::post('/periode/store', [PeriodeController::class, 'store'])->name('periode.store');
    Route::get('/periode/edit/{id}', [PeriodeController::class, 'edit'])->name('periode.edit');
    Route::post('/periode/update', [PeriodeController::class, 'update'])->name('periode.update');
    Route::post('/periode/destroy', [PeriodeController::class, 'destroy'])->name('periode.destroy');
    Route::post('/periode/aktifkan', [PeriodeController::class, 'aktifkan'])->name('periode.aktifkan');

    Route::get('jam', [JamPelajaranController::class, 'index'])->name('jam.index');
    Route::post('jam', [JamPelajaranController::class, 'gantiStatus'])->name('jam.ganti');

    Route::get('/target', [TargetController::class, 'index'])->name('target.index');
    Route::post('/target/store', [TargetController::class, 'store'])->name('target.store');
    Route::post('/jumlahPekan', [TargetController::class, 'jumlahPekan'])->name('jumlahPekan');

    Route::get('/laporan/perbulan', [LaporanController::class, 'laporanPerbulan'])->name('laporan.perbulan');
    Route::post('/laporan/perbulan/filter', [LaporanController::class, 'laporanPerbulanFilter'])->name('laporan.perbulan.filter');

    Route::get('/laporan/perkelas', [LaporanController::class, 'laporanPerkelas'])->name('laporan.perkelas');

    
});

Route::get('/jurnal',[JurnalController::class,'index']);
Route::get('/jurnal/umum',[JurnalController::class,'umum']);
Route::get('/jurnal/login',[LoginController::class,'login']);
Route::get('/jurnal/logout',[LoginController::class,'logout']);
Route::post('/jurnal/cekLogin',[LoginController::class,'cekLogin']);
Route::post('/jurnal/store',[JurnalController::class,'store']);
Route::post('/jurnal/store/umum',[JurnalController::class,'storeUmum']);
Route::post('/jurnal/destroy',[JurnalController::class,'destroy'])->name('jurnal.destroy');
Route::get('/guru/profil',[GuruController::class,'profil'])->name('guru.profil');
Route::post('/guru/profilUpdate',[GuruController::class,'profilUpdate'])->name('guru.profilUpdate');
Route::get('/laporan/guru',[LaporanController::class,'laporanGuru'])->name('laporan.guru');
Route::get('/laporan/guru/{id}',[LaporanController::class,'laporanGuruId'])->name('laporan.guru.id');
Route::get('/laporan/tendik/{id}',[LaporanController::class,'laporanTendikId'])->name('laporan.tendik.id');
Route::get('/laporan/tendik/detil/{id}',[LaporanController::class,'laporanTendikDetilId'])->name('laporan.tendik.detil.id');

Route::get('/jurnal/tendik',[JurnalTendikController::class,'index']);
Route::get('/jurnal/tendik/login',[LoginTendikController::class,'login']);
Route::get('/jurnal/tendik/logout',[LoginTendikController::class,'logout']);
Route::post('/jurnal/tendik/cekLogin',[LoginTendikController::class,'cekLogin']);
Route::post('/jurnal/tendik/store',[JurnalTendikController::class,'store']);
Route::post('/jurnal/tendik/destroy',[JurnalTendikController::class,'destroy'])->name('jurnal.tendik.destroy');

Route::get('/jurnal/lampau',[JurnalController::class,'lampau']);
Route::post('/jurnal/store/lampau',[JurnalController::class,'storeLampau']);

Route::get('/jurnal/tendik/lampau',[JurnalTendikController::class,'indexLampau']);
Route::post('/jurnal/tendik/lampau/store',[JurnalTendikController::class,'storeLampau']);

require __DIR__.'/auth.php';
