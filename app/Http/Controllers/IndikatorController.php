<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indikator;

class IndikatorController extends Controller
{
    public function index()
    {
        return Indikator::with('aspek')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_aspek' => 'required',
            'nama_indikator' => 'required'
        ]);

        return Indikator::create($request->all());
    }

    public function destroy($id)
    {
        Indikator::where('id_indikator', $id)->delete();
        return response()->json(['message'=>'Deleted']);
    }
}