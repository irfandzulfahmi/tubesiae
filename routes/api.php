<?php
use App\Http\Controllers\API\UlasanController;
use App\Http\Controllers\API\BarangController;
use App\Http\Controllers\API\PesanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Barang;
use App\Models\Pembeli;

//probis 1
Route::get('product', [BarangController::class, 'index']);
Route::post('product/store', [BarangController::class, 'store']);
Route::get('product/show/{id}', [BarangController::class, 'show']);
Route::put('product/update/{id}', [BarangController::class, 'update']);
Route::delete('product/destroy/{id}', [BarangController::class, 'destroy']);
Route::get('product/showbyproduct/{product}', [BarangController::class, 'searchByProduct']);
//probis 2
// untuk daftar barang
Route::get('/barang', function () {
    return Barang::all();
});

// untuk menambah pembeli
Route::post('/pembeli', function (Request $request) {
    $pembeli = new Pembeli;
    $pembeli->nama_pembeli = $request->input('nama_pembeli');
    $pembeli->id_barang = $request->input('id_barang'); //barang yang ingin dibeli diambi dari table barang
    $pembeli->save();

    return response()->json(['message' => 'Pembeli berhasil ditambahkan'], 201);
    
    
});

//probis 3
Route::get('ulasan', [UlasanController::class, 'index']);
Route::post('ulasan', [UlasanController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//probis 4
Route::get('/pembeli', function () {
    $pembeli = Pembeli::with('barang:id,nama_product,harga_product,deskripsi_product')->get();
    
    return response()->json($pembeli, 200);
});

//probis 5
Route::post('/pesan', [PesanController::class, 'store']);
Route::get('/pesan', [PesanController::class, 'index']);

//probis 6
Route::delete('/barang/{id}', function ($id) {
    $pembeli = Pembeli::where('id_barang', $id)->delete();

    if ($pembeli) {
        return response()->json(['message' => 'Data pembeli terkait barang berhasil dihapus'], 200);
    }

    $barang = Barang::find($id);

    if (!$barang) {
        return response()->json(['message' => 'Barang tidak ditemukan'], 404);
    }

    $barang->delete();

    return response()->json(['message' => 'Barang berhasil dihapus'], 200);
});
