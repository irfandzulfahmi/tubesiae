<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use App\Models\Pembeli;
use Exception;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    /**
     * Menyimpan ulasan baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pembeli' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $ulasan = new \App\Models\Ulasan;
        $ulasan->id_pembeli = $request->id_pembeli;
        $ulasan->rating = $request->rating;
        $ulasan->save();

        return response()->json(['message' => 'Ulasan berhasil disimpan'], 201);
    }

    /**
     * Menampilkan rating, id_pembeli, dan nama_pembeli.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $ulasans = \App\Models\Ulasan::select('rating', 'id_pembeli')
                ->with('pembeli:id,nama_pembeli')
                ->get();

            return response()->json(['ulasans' => $ulasans], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengambil data'], 500);
        }
    }
}
