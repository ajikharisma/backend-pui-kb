<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\AspekController;
use App\Http\Controllers\HasilAnalisisController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\AuthController;

// LOGIN
Route::post('/login', [AuthController::class, 'apiLogin']);

// ANAK
Route::get('/anak', [AnakController::class, 'index']);
Route::post('/anak', [AnakController::class, 'store']);
Route::post('/anak/{id}', [AnakController::class, 'update']);
Route::delete('/anak/{id}', [AnakController::class, 'destroy']);

// PENILAIAN (INTI)
Route::get('/penilaian', [PenilaianController::class, 'index']);
Route::post('/penilaian', [PenilaianController::class, 'store']);

// INDIKATOR
Route::get('/indikator', [IndikatorController::class, 'index']);
Route::post('/indikator', [IndikatorController::class, 'store']);
Route::delete('/indikator/{id}', [IndikatorController::class, 'destroy']);

// ASPEK
Route::get('/aspek', [AspekController::class, 'index']);
Route::post('/aspek', [AspekController::class, 'store']);
Route::put('/aspek/{id}', [AspekController::class, 'update']);
Route::delete('/aspek/{id}', [AspekController::class, 'destroy']);

// HASIL ANALISIS
Route::get('/hasil', [HasilAnalisisController::class, 'index']);
Route::get('/hasil/{id}', [HasilAnalisisController::class, 'showByAnak']);
Route::get('/hasil/{id}/{periode}', [HasilAnalisisController::class, 'showByAnakDanPeriode']);
Route::post('/hasil/generate', [HasilAnalisisController::class, 'generate']);

// GURU
Route::get('/guru', [GuruController::class, 'index']);
Route::post('/guru', [GuruController::class, 'store']);
Route::post('/guru/{id}', [GuruController::class, 'update']);
Route::delete('/guru/{id}', [GuruController::class, 'destroy']);

// ORANG TUA
Route::get('/orang-tua', [OrangTuaController::class, 'index']);
Route::post('/orang-tua', [OrangTuaController::class, 'store']);
Route::post('/orang-tua/{id}', [OrangTuaController::class, 'update']);
Route::delete('/orang-tua/{id}', [OrangTuaController::class, 'destroy']);

// ANALISIS (GENERATE)
Route::post('/analisis/generate', [AnalisisController::class, 'generate']);

// 🔥 SEMUA ROUTE MOBILE ORANG TUA — HANYA 1 GROUP auth:sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Dashboard
    Route::get('/parent/dashboard', [OrangTuaController::class, 'getDashboardData']);

    // Detail perkembangan per minggu
    Route::get('/parent/perkembangan/{minggu}', [OrangTuaController::class, 'getDetailPerkembangan']);

    // List hasil analisis anak
    Route::get('/parent/analisis', [OrangTuaController::class, 'getListAnalisis']);

    // Detail hasil analisis per minggu
    Route::get('/parent/analisis/{minggu}', [OrangTuaController::class, 'getDetailAnalisis']);

    Route::get('/parent/profil',           [OrangTuaController::class, 'getProfil']);
    Route::post('/parent/profil/anak',     [OrangTuaController::class, 'updateProfilAnak']);
    Route::post('/parent/profil/ortu',     [OrangTuaController::class, 'updateProfilOrtu']);
});

// 🔥 ROUTE FOTO STORAGE
Route::get('/foto/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);

    if (!file_exists($fullPath)) {
        abort(404);
    }

    return response()->file($fullPath, [
        'Access-Control-Allow-Origin'  => '*',
        'Access-Control-Allow-Headers' => '*',
        'Cache-Control'                => 'public, max-age=86400',
    ]);
})->where('path', '.*');