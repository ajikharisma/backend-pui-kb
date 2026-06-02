<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Guru;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\OrangTua;
use App\Models\Anak;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    // 🔥 GET semua guru
    public function index()
    {
        return response()->json(
            Guru::with('user')->get()
        );
    }

    // 🔥 INSERT guru
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_user' => 'required|exists:users,id_user',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'alamat' => 'nullable|string',
                'tanggal_lahir' => 'nullable|date',
                'jenis_kelamin' => 'nullable|in:L,P'
            ]);

            // 🔥 HANDLE UPLOAD FOTO
            $path = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('guru', 'public');
            }

            $guru = Guru::create([
                'id_user' => $request->id_user,
                'foto' => $path,
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);

            return response()->json([
                'message' => 'Data guru berhasil ditambahkan',
                'data' => $guru
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal menambahkan guru',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    // 🔥 UPDATE guru
    public function update(Request $request, $id)
    {
        try {
            $guru = Guru::findOrFail($id);

            $request->validate([
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'alamat' => 'nullable|string',
                'tanggal_lahir' => 'nullable|date',
                'jenis_kelamin' => 'nullable|in:L,P'
            ]);

            // 🔥 UPDATE FOTO
            if ($request->hasFile('foto')) {

                // ❗ HAPUS FOTO LAMA (biar tidak numpuk)
                if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                    Storage::disk('public')->delete($guru->foto);
                }

                $path = $request->file('foto')->store('guru', 'public');
                $guru->foto = $path;
            }

            $guru->alamat = $request->alamat;
            $guru->tanggal_lahir = $request->tanggal_lahir;
            $guru->jenis_kelamin = $request->jenis_kelamin;

            $guru->save();

            return response()->json([
                'message' => 'Data guru berhasil diupdate',
                'data' => $guru
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal update guru',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    // 🔥 DELETE guru
    public function destroy($id)
    {
        try {
            $guru = Guru::findOrFail($id);

            // ❗ HAPUS FOTO DARI STORAGE
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }

            $guru->delete();

            return response()->json([
                'message' => 'Guru berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal menghapus guru',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    public function tambahMurid()
    {
        $guru = Guru::where('id_user', Auth::id())->first();

        return view('tambah_murid', compact('guru'));
    }

    // METHOD SIMPAN MURID
    public function simpanMurid(Request $request)
    {
        // =========================
        // GENERATE ID USER
        // =========================
        $lastUser = User::latest()->first();

        if ($lastUser) {

            $lastNumber = (int) substr($lastUser->id_user, 3);

            $newUserId = 'USR' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        } else {

            $newUserId = 'USR001';

        }

        // =========================
        // SIMPAN USER
        // =========================
        $user = User::create([

            'id_user' => $newUserId,

            'nama' => $request->nama_ortu,

            'email' => $request->email,

            'no_hp' => $request->no_hp,

            'password' => Hash::make($request->password),

            'role' => 'orang_tua',

        ]);

        // =========================
        // GENERATE ID ORANG TUA
        // =========================
        $lastOrtu = OrangTua::latest()->first();

        if ($lastOrtu) {

            $lastNumber = (int) substr($lastOrtu->id_orang_tua, 3);

            $newOrtuId = 'ORT' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        } else {

            $newOrtuId = 'ORT001';

        }

        // =========================
        // SIMPAN ORANG TUA
        // =========================
        $orangTua = OrangTua::create([

            'id_orang_tua' => $newOrtuId,

            'id_user' => $user->id_user,

            'alamat' => $request->alamat,

        ]);

        // =========================
        // GENERATE ID ANAK
        // =========================
        $lastAnak = Anak::latest()->first();

        if ($lastAnak) {

            $lastNumber = (int) substr($lastAnak->id_anak, 3);

            $newAnakId = 'ANK' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        } else {

            $newAnakId = 'ANK001';

        }

        // =========================
        // FOTO
        // =========================
        $fotoPath = null;

        if ($request->hasFile('foto')) {

            $fotoPath = $request->file('foto')->store('foto-anak', 'public');

        }

        // =========================
        // SIMPAN ANAK
        // =========================
        Anak::create([

            'id_anak' => $newAnakId,

            'id_orang_tua' => $orangTua->id_orang_tua,

            'nama_anak' => $request->nama_anak,

            'kelompok' => $request->kelompok,

            'tanggal_lahir' => $request->tanggal_lahir,

            'tempat_lahir' => $request->tempat_lahir,

            'jenis_kelamin' => $request->jenis_kelamin,

            'foto' => $fotoPath,

        ]);

        return redirect('/data-murid')
            ->with('success', 'Data murid berhasil ditambahkan');
    }

    // METHOD EDIT MURID
    public function editMurid($id)
    {
        // AMBIL DATA ANAK
        $anak = Anak::where('id_anak', $id)->firstOrFail();

        // AMBIL DATA ORANG TUA
        $orangTua = OrangTua::where('id_orang_tua', $anak->id_orang_tua)->first();

        // AMBIL DATA USER ORANG TUA
        $user = User::where('id_user', $orangTua->id_user)->first();

        // AMBIL DATA GURU LOGIN
        $guru = Guru::where('id_user', Auth::id())->first();

        return view('edit_murid', compact(
            'anak',
            'orangTua',
            'user',
            'guru'
        ));
    }

    // METHOD UPDATE MURID
    public function updateMurid(Request $request, $id)
    {
        // cari data anak
        $anak = Anak::where('id_anak', $id)->firstOrFail();

        // update data anak
        $anak->nama_anak     = $request->nama_anak;
        $anak->tempat_lahir  = $request->tempat_lahir;
        $anak->tanggal_lahir = $request->tanggal_lahir;
        $anak->jenis_kelamin = $request->jenis_kelamin;
        $anak->agama         = $request->agama;

        // upload foto baru
        if ($request->hasFile('foto')) {

            // hapus foto lama
            if ($anak->foto && Storage::disk('public')->exists($anak->foto)) {

                Storage::disk('public')->delete($anak->foto);

            }

            // simpan foto baru
            $fotoPath = $request->file('foto')->store('foto-anak', 'public');

            $anak->foto = $fotoPath;
        }

        $anak->save();

        // update user orang tua
        $orangTua = OrangTua::where('id_orang_tua', $anak->id_orang_tua)->first();

        $user = User::where('id_user', $orangTua->id_user)->firstOrFail();

        $user->nama  = $request->nama;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;

        // update password jika diisi
        if ($request->password) {

            $user->password = Hash::make($request->password);

        }

        $user->save();

        // update alamat orang tua
        $orangTua->alamat = $request->alamat;
        $orangTua->save();

        return redirect('/data-murid')
            ->with('success', 'Data murid berhasil diperbarui');
    }
    
    // HAPUS MURID
    public function hapusMurid($id)
    {
        // cari data anak
        $anak = Anak::findOrFail($id);

        // hapus foto jika ada
        if ($anak->foto && file_exists(storage_path('app/public/' . $anak->foto))) {

            unlink(storage_path('app/public/' . $anak->foto));

        }

        // hapus data anak
        $anak->delete();

        return redirect('/data-murid')
            ->with('success', 'Data murid berhasil dihapus');
    }

    // DETAIL MURID
    public function detailMurid($id)
    {
        // data anak
        $anak = Anak::where('id_anak', $id)->firstOrFail();

        // data orang tua
        $orangTua = OrangTua::where(
            'id_orang_tua',
            $anak->id_orang_tua
        )->first();

        // data user orang tua
        $user = User::where(
            'id_user',
            $orangTua->id_user
        )->first();

        // guru login
        $guru = Guru::where(
            'id_user',
            Auth::id()
        )->first();

        return view('detail_murid', compact(
            'anak',
            'orangTua',
            'user',
            'guru'
        ));
    }

    // ================================
    // HALAMAN PROFIL GURU
    // ================================
    public function profilGuru()
    {
        $user = User::where(
            'id_user',
            Auth::user()->id_user
        )->firstOrFail();

        $guru = Guru::where(
            'id_user',
            $user->id_user
        )->firstOrFail();

        return view('profil-guru', compact(
            'guru',
            'user'
        ));
    }


    // ================================
    // UPDATE PROFIL GURU
    // ================================
    public function updateProfilGuru(Request $request)
    {
        $user = User::where(
            'id_user',
            Auth::user()->id_user
        )->firstOrFail();

        $guru = Guru::where(
            'id_user',
            $user->id_user
        )->firstOrFail();

        $request->validate([

            'nama' => 'required',

            'email' => 'required|email',

            'no_hp' => 'required',

            'alamat' => 'nullable',

            'tanggal_lahir' => 'nullable|date',

            'jenis_kelamin' => 'nullable',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        // ======================
        // UPDATE USER
        // ======================

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;

        $user->save();

        // ======================
        // UPDATE GURU
        // ======================

        $guru->alamat = $request->alamat;
        $guru->tanggal_lahir = $request->tanggal_lahir;
        $guru->jenis_kelamin = $request->jenis_kelamin;

        // FOTO
        if ($request->hasFile('foto')) {

            // hapus foto lama
            if (
                $guru->foto &&
                Storage::disk('public')->exists($guru->foto)
            ) {

                Storage::disk('public')->delete($guru->foto);

            }

            // upload baru
            $fotoPath = $request
                ->file('foto')
                ->store('foto-guru', 'public');

            $guru->foto = $fotoPath;
        }

        $guru->save();

        return redirect()
            ->back()
            ->with('success', 'Profil berhasil diperbarui');
    }
}