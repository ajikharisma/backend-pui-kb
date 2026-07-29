<?php

namespace App\Http\Controllers;

use App\Models\CatatanOrangTua;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;

class CatatanOrangTuaController extends Controller
{
    public function index()
    {
        $guru = Guru::where('id_user', Auth::id())->first();

        $catatan = CatatanOrangTua::with([
            'anak',
            'orangTua.user'
        ])
        ->latest('tanggal')
        ->get();

        $totalCatatan = $catatan->count();

        return view('catatan-anak-rumah', compact(
            'catatan',
            'totalCatatan',
            'guru'
        ));
    }

    public function show($id)
    {
        $catatan = CatatanOrangTua::with([
            'anak.orangTua.user',
            'orangTua.user'
        ])->findOrFail($id);

        if (!$catatan->dibaca_at) {
            $catatan->update([
                'dibaca_at' => now()
            ]);
        }

        $guru = Guru::where('id_user', Auth::id())->first();

        return view('detail-catatan-anak-rumah', compact('catatan', 'guru'));
    }
}   
