<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use App\Models\Pembeli;
use Exception;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    /**
     * Menyimpan Pesan baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pembeli' => 'required',
            'pesan' => 'required',
        ]);

        $pesan = new \App\Models\Pesan;
        $pesan->id_pembeli = $request->id_pembeli;
        $pesan->pesan = $request->pesan;
        $pesan->save();

        return response()->json(['message' => 'Pesan berhasil disimpan'], 201);
    }

    /**
     * Menampilkan pesan, id_pembeli, dan nama_pembeli.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $pesans = \App\Models\Pesan::select('pesan', 'id_pembeli')
                ->with('pembeli:id,nama_pembeli')
                ->get();

            return response()->json(['pesans' => $pesans], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengambil data'], 500);
        }
    }
}
