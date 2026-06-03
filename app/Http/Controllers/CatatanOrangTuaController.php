<?php

namespace App\Http\Controllers;

use App\Models\CatatanOrangTua;

class CatatanOrangTuaController extends Controller
{
    public function index()
    {
        $catatan = CatatanOrangTua::with([
            'anak',
            'orangTua.user'
        ])
        ->latest('tanggal')
        ->get();

        $totalCatatan = $catatan->count();

        return view('catatan-anak-rumah', compact(
            'catatan',
            'totalCatatan'
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

        return view('detail-catatan-anak-rumah', compact('catatan'));
    }
}   
