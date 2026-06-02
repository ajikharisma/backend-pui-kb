<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Guru;
use App\Models\OrangTua;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $guru = Guru::where('id_user', Auth::id())->first();

        // TOTAL DATA
        $totalAnak = Anak::count();

        $totalLaki = Anak::where('jenis_kelamin', 'Laki-laki')->count();

        $totalPerempuan = Anak::where('jenis_kelamin', 'Perempuan')->count();

        // INI YANG BENAR
        $totalOrangTua = OrangTua::count();

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
    }
}