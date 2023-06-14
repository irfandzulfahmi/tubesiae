<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Pembeli;
use Exception;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required',
            'id_barang' => 'required|exists:barang,id',
            
        ]);

        $pembeli = Pembeli::create([
            'nama_pembeli' => $request->input('nama_pembeli'),
            'id_barang' => $request->input('id_barang'),
        ]);

        return response()->json(['message' => 'Pembeli berhasil ditambahkan', 'data' => $pembeli], 201);
    }
}
