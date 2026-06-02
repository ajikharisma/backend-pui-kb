<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Models\Anak;
use App\Models\User;
use App\Models\OrangTua;
use App\Models\Guru;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PenilaianController;

// 🔥 HALAMAN AWAL (langsung ke login)
Route::get('/', function () {
    return view('auth.login');
});

// 🔥 HALAMAN LOGIN
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// 🔥 PROSES LOGIN
Route::post('/login', [AuthController::class, 'login']);

// 🔥 LOGOUT
Route::post('/logout', [AuthController::class, 'logout']);

// 🔥 DASHBOARD (SETELAH LOGIN)
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth');

// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->middleware('auth');

// DASHBOARD
Route::get('/dashboard', function () {

    // AMBIL DATA GURU YANG LOGIN
    $guru = Guru::where('id_user', Auth::id())->first();

    // FILTER ANAK BERDASARKAN KELOMPOK GURU
    $totalAnak = Anak::where('kelompok', $guru->kelompok)->count();

    // TOTAL LAKI-LAKI
    $totalLaki = Anak::where('kelompok', $guru->kelompok)
                    ->where('jenis_kelamin', 'Laki-laki')
                    ->count();

    // TOTAL PEREMPUAN
    $totalPerempuan = Anak::where('kelompok', $guru->kelompok)
                        ->where('jenis_kelamin', 'Perempuan')
                        ->count();

    /*
    |--------------------------------------------------------------------------
    | TOTAL ORANG TUA SESUAI KELOMPOK
    |--------------------------------------------------------------------------
    | ambil parent dari anak yang ada di kelompok guru
    */

    $totalOrangTua = OrangTua::whereIn(
        'id_orang_tua',
        Anak::where('kelompok', $guru->kelompok)
            ->pluck('id_orang_tua')
    )->count();

    // PERSENTASE
    $persenLaki = $totalAnak > 0
        ? round(($totalLaki / $totalAnak) * 100)
        : 0;

    $persenPerempuan = $totalAnak > 0
        ? round(($totalPerempuan / $totalAnak) * 100)
        : 0;

    return view('dashboard', compact(
        'guru',
        'totalAnak',
        'totalLaki',
        'totalPerempuan',
        'totalOrangTua',
        'persenLaki',
        'persenPerempuan'
    ));

})->middleware('auth');

// DATA ANAK
Route::get('/data-murid', function () {

    $guru = Guru::where('id_user', Auth::id())->first();

    // FILTER SESUAI KELOMPOK GURU
    $anak = Anak::where('kelompok', $guru->kelompok)
                ->paginate(5);

    // TOTAL SESUAI KELOMPOK
    $totalAnak = Anak::where('kelompok', $guru->kelompok)->count();

    $totalLaki = Anak::where('kelompok', $guru->kelompok)
                    ->where('jenis_kelamin', 'Laki-laki')
                    ->count();

    $totalPerempuan = Anak::where('kelompok', $guru->kelompok)
                        ->where('jenis_kelamin', 'Perempuan')
                        ->count();

    return view('data_murid', compact(
        'guru',
        'anak',
        'totalAnak',
        'totalLaki',
        'totalPerempuan'
    ));

})->middleware('auth');

// ROUTE NAMBAH ANAK
Route::get('/tambah-murid', [GuruController::class, 'tambahMurid']);
Route::post('/simpan-murid', [GuruController::class, 'simpanMurid']);

// ROUTE EDIT ANAK
Route::get('/edit-murid/{id}', [GuruController::class, 'editMurid'])
    ->name('edit.murid');

Route::put('/update-murid/{id}', [GuruController::class, 'updateMurid'])
    ->name('update.murid');

Route::get('/hapus-murid/{id}', [GuruController::class, 'hapusMurid'])
    ->name('hapus.murid');

// DETAIL MURID
Route::get('/detail-murid/{id}', [GuruController::class, 'detailMurid'])
    ->name('detail.murid');

// ROUTE PENILAIAN
// HALAMAN INPUT PENILAIAN
Route::get('/input-penilaian', [PenilaianController::class, 'create'])
    ->name('penilaian.create');

// SIMPAN PENILAIAN
Route::post('/input-penilaian', [PenilaianController::class, 'store'])
    ->name('penilaian.store');

Route::get('/get-indikator/{id}', [PenilaianController::class, 'getIndikator']);

Route::get('/get-asesmen/{id}', [PenilaianController::class, 'getAsesmen']);

// HALAMAN PERKEMBANGAN ANAK
Route::get('/perkembangan-anak', [PenilaianController::class, 'perkembangan'])
    ->name('perkembangan.anak');

// DETAIL PENILAIAN
Route::get(
    '/detail-perkembangan/{id_anak}/{minggu}',
    [PenilaianController::class, 'detailPerkembangan']
)->name('detail-perkembangan');

// PROSES ANALISIS AI
Route::post(
    '/proses-analisis/{id_anak}/{minggu}',
    [PenilaianController::class, 'prosesAnalisis']
)->name('proses-analisis');

// HALAMAN LIST HASIL ANALISIS
Route::get('/hasil-analisis', [PenilaianController::class, 'hasilAnalisis'])
    ->name('hasil.analisis');

// HALAMAN DETAIL HASIL ANALISIS
Route::get(
    '/detail-hasil-analisis/{id_anak}/{minggu}',
    [PenilaianController::class, 'detailHasilAnalisis']
)->name('detail.hasil.analisis');

// HALAMAN PROFIL GURU
Route::get('/profil-guru', [GuruController::class, 'profilGuru']);

// 1. Ubah Route::post menjadi Route::put (sesuai @method('PUT') di blade)
// 2. Tambahkan ->name('profil-guru.update') di ujungnya
Route::put('/profil-guru/update', [GuruController::class, 'updateProfilGuru'])->name('profil-guru.update');

