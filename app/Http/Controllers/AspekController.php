<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AspekPerkembangan;

class AspekController extends Controller
{
    // 🔥 GET ALL
    public function index()
    {
        return response()->json(
            AspekPerkembangan::with('indikator')->get()
        );
    }

    // 🔥 CREATE
    public function store(Request $request)
    {
        $request->validate([
            'nama_aspek' => 'required'
        ]);

        $data = AspekPerkembangan::create([
            'nama_aspek' => $request->nama_aspek
        ]);

        return response()->json($data, 201);
    }

    // 🔥 UPDATE
    public function update(Request $request, $id)
    {
        AspekPerkembangan::where('id_aspek', $id)->update([
            'nama_aspek' => $request->nama_aspek
        ]);

        return response()->json(['message' => 'Updated']);
    }

    // 🔥 DELETE
    public function destroy($id)
    {
        AspekPerkembangan::where('id_aspek', $id)->delete();

        return response()->json(['message' => 'Deleted']);
    }
}