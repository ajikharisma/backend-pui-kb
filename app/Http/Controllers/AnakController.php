<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Anak;
use Illuminate\Support\Facades\Storage;

class AnakController extends Controller
{
    // 🔥 GET semua anak
    public function index()
    {
        $guru = Auth::user();

        $anak = Anak::with('orangTua')
                    ->where('kelompok', $guru->kelompok)
                    ->get();

        return response()->json($anak);
    }

    // 🔥 INSERT anak
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_anak' => 'required|string',
                'tanggal_lahir' => 'required|date',
                'tempat_lahir' => 'nullable|string',
                'jenis_kelamin' => 'required|in:L,P',
                'kelompok' => 'required|string',
                'id_orang_tua' => 'required|exists:orang_tua,id_orang_tua',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'agama' => 'required|string'
            ]);

            // 🔥 HANDLE FOTO
            $path = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('anak', 'public');
            }

            $anak = Anak::create([
                'nama_anak' => $request->nama_anak,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tempat_lahir' => $request->tempat_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'kelompok' => $request->kelompok,
                'id_orang_tua' => $request->id_orang_tua,
                'foto' => $path,
                'agama' => $request->agama
            ]);

            return response()->json([
                'message' => 'Data anak berhasil ditambahkan',
                'data' => $anak
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal menambahkan anak',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    // 🔥 UPDATE anak
    public function update(Request $request, string $id)
    {
        try {
            $anak = Anak::findOrFail($id);

            $request->validate([
                'nama_anak' => 'nullable|string',
                'tanggal_lahir' => 'nullable|date',
                'tempat_lahir' => 'nullable|string',
                'jenis_kelamin' => 'nullable|in:L,P',
                'kelompok' => 'nullable|string',
                'id_orang_tua' => 'nullable|exists:orang_tua,id_orang_tua',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'agama' => 'nullable|string'
            ]);

            // 🔥 UPDATE FOTO
            if ($request->hasFile('foto')) {

                // hapus foto lama
                if ($anak->foto && Storage::disk('public')->exists($anak->foto)) {
                    Storage::disk('public')->delete($anak->foto);
                }

                $path = $request->file('foto')->store('anak', 'public');
                $anak->foto = $path;
            }

            // 🔥 UPDATE FIELD
            $anak->nama_anak = $request->nama_anak ?? $anak->nama_anak;
            $anak->tanggal_lahir = $request->tanggal_lahir ?? $anak->tanggal_lahir;
            $anak->tempat_lahir = $request->tempat_lahir ?? $anak->tempat_lahir;
            $anak->jenis_kelamin = $request->jenis_kelamin ?? $anak->jenis_kelamin;
            $anak->kelompok = $request->kelompok ?? $anak->kelompok;
            $anak->id_orang_tua = $request->id_orang_tua ?? $anak->id_orang_tua;
            $anak->agama = $request->agama ?? $anak->agama;
            $anak->save();

            return response()->json([
                'message' => 'Data anak berhasil diupdate',
                'data' => $anak
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal update anak',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    // 🔥 DELETE anak
    public function destroy(string $id)
    {
        try {
            $anak = Anak::findOrFail($id);

            // hapus foto
            if ($anak->foto && Storage::disk('public')->exists($anak->foto)) {
                Storage::disk('public')->delete($anak->foto);
            }

            $anak->delete();

            return response()->json([
                'message' => 'Data anak berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal menghapus anak',
                'detail' => $e->getMessage()
            ], 500);
        }
    }
}