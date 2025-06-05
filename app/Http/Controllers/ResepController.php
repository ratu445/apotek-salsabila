<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Barang;
use App\Models\Pengguna;
use App\Models\ResepItem;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function index()
    {
        $reseps = Resep::with(['pengguna', 'items.barang'])->get();
        return view('resep.index', compact('reseps'));
    }

    public function create()
    {
        $penggunas = Pengguna::all();
        $barangs = Barang::all();
        return view('resep.create', compact('penggunas', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pengguna' => 'required|exists:pengguna,id_pengguna',
            'nama_pasien' => 'required|max:125',
            'diagnosa' => 'nullable',
            'tgl_resep' => 'required|date',
            'catatan' => 'nullable',
            'items' => 'required|array|min:1',
            'items.*.id_barang' => 'required|exists:barang,id_barang',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.aturan_pakai' => 'required'
        ]);

        $resep = Resep::create($request->only([
            'id_pengguna', 'nama_pasien', 'diagnosa', 'tgl_resep', 'catatan'
        ]));

        foreach ($request->items as $item) {
            ResepItem::create([
                'id_resep' => $resep->id_resep,
                'id_barang' => $item['id_barang'],
                'jumlah' => $item['jumlah'],
                'aturan_pakai' => $item['aturan_pakai']
            ]);
        }

        return redirect()->route('resep.index')->with('success', 'Resep berhasil dibuat');
    }

    public function show(Resep $resep)
    {
        $resep->load(['pengguna', 'items.barang']);
        return view('resep.show', compact('resep'));
    }

    public function destroy(Resep $resep)
    {
        $resep->items()->delete();
        $resep->delete();
        return redirect()->route('resep.index')->with('success', 'Resep berhasil dihapus');
    }
}