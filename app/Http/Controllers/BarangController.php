<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with(['kategori', 'supplier'])->get();
        return view('barang.index', compact('barangs'));
    }
    
    public function create()
    {
        $kategoris = Kategori::all();
        $suppliers = Supplier::all();
        return view('barang.create', compact('kategoris', 'suppliers'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'id_supplier' => 'required|exists:suppliers,id_supplier',
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'nama_barang' => 'required',
            'keterangan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'expired_date' => 'nullable|date',
            'produsen' => 'nullable',
            'komposisi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('barang-images', 'public');
        }
        
        Barang::create($validated);
        
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }
    
    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }
    
    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        $suppliers = Supplier::all();
        return view('barang.edit', compact('barang', 'kategoris', 'suppliers'));
    }
    
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'id_supplier' => 'required|exists:suppliers,id_supplier',
            'kode_barang' => 'required|unique:barangs,kode_barang,'.$barang->id_barang.',id_barang',
            'nama_barang' => 'required',
            'keterangan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'expired_date' => 'nullable|date',
            'produsen' => 'nullable',
            'komposisi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('barang-images', 'public');
        }
        
        $barang->update($validated);
        
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }
    
    public function destroy(Barang $barang)
    {
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }
        
        $barang->delete();
        
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
    
    public function api(Request $request)
    {
        $search = $request->search;
        
        $barangs = Barang::when($search, function($query) use ($search) {
            $query->where('nama_barang', 'like', "%$search%")
                  ->orWhere('kode_barang', 'like', "%$search%");
        })->limit(10)->get();
        
        $response = [];
        foreach ($barangs as $barang) {
            $response[] = [
                'id' => $barang->id_barang,
                'text' => $barang->kode_barang . ' - ' . $barang->nama_barang . ' (Stok: ' . $barang->stok . ')',
                'harga' => $barang->harga,
                'stok' => $barang->stok
            ];
        }
        
        return response()->json($response);
    }
}
