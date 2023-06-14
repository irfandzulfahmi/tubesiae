<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use Exception;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();

        return response()->json([
            'success' => true,
            'data' => $barang
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $barang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_product' => 'required',
            'harga_product' => 'required|integer',
            'deskripsi_product' => 'required',
            'jumlah_product' => 'required|integer',
        ]);

        $barang = Barang::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $barang
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_product' => 'required',
            'harga_product' => 'required|integer',
            'deskripsi_product' => 'required',
            'jumlah_product' => 'required|integer',
        ]);

        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found'
            ], 404);
        }

        $barang->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $barang
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang not found'
            ], 404);
        }

        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Barang deleted successfully'
        ]);
    }

    /**
     * Search for products by name.
     *
     * @param  string  $product
     * @return \Illuminate\Http\Response
     */
    public function searchByProduct($product)
    {
        $barang = Barang::where('nama_product', 'LIKE', "%$product%")->get();

        return response()->json([
            'success' => true,
            'data' => $barang
        ]);
    }
}
