<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\Barang;
use App\Models\Resep;
use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    public function index()
    {
        $permintaans = Permintaan::with(['resep', 'barangPermintaans.barang'])
            ->orderBy('tgl', 'desc')
            ->get();
            
        return view('permintaan.index', compact('permintaans'));
    }

    public function create()
    {
        $reseps = Resep::with('items.barang')->get();
        $barangs = Barang::all();
        return view('permintaan.create', compact('reseps', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl' => 'required|date',
            'id_resep' => 'nullable|exists:resep,id_resep',
            'payment' => 'required',
            'items' => 'required|array|min:1',
            'items.*.id_barang' => 'required|exists:barang,id_barang',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.harga_satuan' => 'required|numeric|min:0'
        ]);

        // Hitung total bayar
        $totalBayar = collect($request->items)->sum(function ($item) {
            return $item['jumlah'] * $item['harga_satuan'];
        });

        // Buat permintaan
        $permintaan = Permintaan::create([
            'tgl' => $request->tgl,
            'total_bayar' => $totalBayar,
            'payment' => $request->payment,
            'status' => Permintaan::STATUS_BELUM_DIPROSES,
            'id_resep' => $request->id_resep
        ]);

        // Tambahkan barang permintaan
        foreach ($request->items as $item) {
            $permintaan->barangPermintaans()->create([
                'id_barang' => $item['id_barang'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga_satuan']
            ]);

            // Kurangi stok barang
            $barang = Barang::find($item['id_barang']);
            $barang->stok -= $item['jumlah'];
            $barang->save();
        }

        return redirect()->route('permintaan.index')
            ->with('success', 'Permintaan berhasil dibuat');
    }

    public function show(Permintaan $permintaan)
    {
        $permintaan->load(['barangPermintaans.barang', 'resep.items.barang']);
        return view('permintaan.show', compact('permintaan'));
    }

    public function updateStatus(Request $request, Permintaan $permintaan)
    {
        $request->validate([
            'status' => 'required|in:0,1,2,3'
        ]);

        $permintaan->update(['status' => $request->status]);

        return back()->with('success', 'Status permintaan berhasil diperbarui');
    }

    public function destroy(Permintaan $permintaan)
    {
        // Kembalikan stok barang
        foreach ($permintaan->barangPermintaans as $item) {
            $barang = Barang::find($item->id_barang);
            $barang->stok += $item->jumlah;
            $barang->save();
        }

        $permintaan->barangPermintaans()->delete();
        $permintaan->delete();

        return redirect()->route('permintaan.index')
            ->with('success', 'Permintaan berhasil dihapus');
    }
}