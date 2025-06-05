<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangApiController extends Controller
{
    public function index()
    {
        $barangs = Barang::with(['kategori', 'supplier'])->get();
        return response()->json($barangs);
    }

    public function show($id)
    {
        $barang = Barang::with(['kategori', 'supplier'])->find($id);
        
        if (!$barang) {
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }

        return response()->json($barang);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        
        $barangs = Barang::where('nama_barang', 'like', "%$keyword%")
            ->orWhere('kode_barang', 'like', "%$keyword%")
            ->with(['kategori', 'supplier'])
            ->get();

        return response()->json($barangs);
    }
}