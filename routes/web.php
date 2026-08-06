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
use App\Http\Controllers\CatatanOrangTuaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RaporController;

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

// ROUTE CATATAN ORANG TUA
Route::get('/catatan-anak-rumah', [CatatanOrangTuaController::class, 'index'])
    ->name('catatan-anak-rumah');

Route::get('/catatan-anak-rumah/{id}', [CatatanOrangTuaController::class, 'show'])
    ->name('catatan-anak-rumah.detail');

Route::get(
    '/catatan-anak-rumah/{id}',
    [CatatanOrangTuaController::class, 'show']
)->name('catatan.show');

// Laporan PDF — hanya bisa diakses oleh yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/laporan/perkembangan/{id_anak}/{minggu}',
        [LaporanController::class, 'laporanPerkembangan']
    )->name('laporan.perkembangan');

    Route::get('/laporan/analisis/{id_anak}/{minggu}',
        [LaporanController::class, 'laporanAnalisis']
    )->name('laporan.analisis');
});

// Generate Rapor
Route::middleware('auth')->prefix('rapor')->name('rapor.')->group(function () {
    Route::get('/',                    [RaporController::class, 'index'])->name('index');
    Route::get('/list',                [RaporController::class, 'list'])->name('list');
    Route::post('/generate',           [RaporController::class, 'generate'])->name('generate');
    Route::post('/simpan/{id_rapor}',  [RaporController::class, 'simpan'])->name('simpan');
    Route::get('/download/{id_rapor}', [RaporController::class, 'download'])->name('download');
});


// ROUTE SEMENTARA UNTUK PREVIEW TEMPLATE CETAK RAPOR
Route::get('/preview-rapor', function () {
    // 1. Buat Data Dummy Anak
    $anak = (object)[
        'nama_anak' => 'Ahmad Raihan',
        'kelompok' => 'A',
        'tempat_lahir' => 'Bintan',
        'tanggal_lahir' => '2021-05-12',
        'foto' => null, // Set null atau path foto jika ada
        'orangTua' => (object)[
            'user' => (object)[
                'nama' => 'Budi Santoso'
            ]
        ]
    ];

    // 2. Buat Data Dummy Rapor (Termasuk Narasi AI)
    $rapor = (object)[
        'tahun_ajaran' => '2025/2026',
        'semester' => 'Semester Genap 2025/2026',
        'fase' => 'Fase Fondasi',
        'tinggi_badan' => '98',
        'berat_badan' => '15',
        'lingkar_kepala' => '50',
        'hadir' => 85,
        'sakit' => 2,
        'izin' => 1,
        'tanpa_keterangan' => 0,

        // Narasi Dummy NABP
        'narasi_nabp_1' => 'Ahmad menunjukkan sikap percaya kepada Tuhan YME dan mulai terbiasa berdoa sebelum dan sesudah kegiatan.',
        'narasi_nabp_2' => 'Anak aktif mencuci tangan sendiri sebelum makan dan menjaga kebersihan diri.',
        'narasi_nabp_3' => 'Anak mau berbagi mainan dengan teman-teman di kelas dan bersikap sopan.',
        'narasi_nabp_4' => 'Anak menunjukkan rasa sayang pada tanaman sekolah dengan membantu menyiramnya.',

        // Narasi Dummy JD
        'narasi_jd_1' => 'Ahmad dapat mengekspresikan emosi senangnya dan mulai mampu mengendalikan emosi saat mengantre.',
        'narasi_jd_2' => 'Anak mengenali dirinya sebagai laki-laki dan bangga dengan karya yang dibuatnya.',
        'narasi_jd_3' => 'Anak mengenali simbol-simbol budaya dan menyanyikan lagu nasional dengan penuh semangat.',
        'narasi_jd_4' => 'Anak memiliki koordinasi motorik kasar yang baik saat melompat dan berlari di halaman.',

        // Narasi Dummy LMSTRS
        'narasi_lmstrs_1' => 'Ahmad mampu menceritakan kembali pengalaman mainnya dengan kalimat sederhana.',
        'narasi_lmstrs_2' => 'Anak antusias mendengarkan cerita dan dapat memegang pensil dengan posisi yang benar.',
        'narasi_lmstrs_3' => 'Anak dapat membilang angka 1-10 dan mengelompokkan benda berdasarkan warna.',
        'narasi_lmstrs_4' => 'Anak mampu menyelesaikan puzzle 12 keping secara mandiri.',
        'narasi_lmstrs_5' => 'Anak menunjukkan rasa ingin tahu tinggi saat melakukan eksperimen mencampur warna.',
        'narasi_lmstrs_6' => 'Anak mengenal penggunaan alat-alat digital sederhana di sekitar dengan bimbingan.',
        'narasi_lmstrs_7' => 'Anak mewarnai gambar dengan rapi dan berani mengekspresikan imajinasinya dalam menggambar.'
    ];

    // 3. Render langsung view Blade
    return view('rapor.cetak', [
        'anak' => $anak,
        'rapor' => $rapor,
        'guru' => 'Siti Aminah, S.Pd',
        'nama_sekolah' => 'KB NURUL AIN'
    ]);
});