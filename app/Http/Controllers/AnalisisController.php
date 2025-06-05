<?php

namespace App\Http\Controllers;

use App\Models\Analisis;
use App\Models\Barang;
use Illuminate\Http\Request;

class AnalisisController extends Controller
{
    public function index()
    {
        $analisis = Analisis::with('barang')->get();
        return view('analisis.index', compact('analisis'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('analisis.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',
            'dt_jml_permintaan' => 'required|integer|min:1',
            'biaya_pemesanan' => 'required|numeric|min:0',
            'biaya_penyimpanan' => 'required|numeric|min:0',
            'hari_aktif' => 'required|integer|min:1',
            'periode' => 'required|integer|min:1',
            'lead_time' => 'required|integer|min:0'
        ]);

        // Hitung EOQ (Economic Order Quantity)
        $eoq = sqrt(
            (2 * $request->dt_jml_permintaan * $request->biaya_pemesanan) / 
            $request->biaya_penyimpanan
        );

        // Hitung ROP (Reorder Point)
        $rop = ($request->dt_jml_permintaan / $request->hari_aktif) * $request->lead_time;

        // Hitung safety stock (10% dari permintaan harian selama lead time)
        $safety_stok = ceil(($request->dt_jml_permintaan / $request->hari_aktif) * $request->lead_time * 0.1);

        // Buat analisis
        Analisis::create([
            'id_barang' => $request->id_barang,
            'dt_jml_permintaan' => $request->dt_jml_permintaan,
            'biaya_pemesanan' => $request->biaya_pemesanan,
            'biaya_penyimpanan' => $request->biaya_penyimpanan,
            'hari_aktif' => $request->hari_aktif,
            'periode' => $request->periode,
            'eoq' => $eoq,
            'rop' => $rop,
            'safety_stok' => $safety_stok,
            'minimal_stok' => ceil($rop + $safety_stok),
            'maksimal_stok' => ceil($rop + $safety_stok + $eoq),
            'lead_time' => $request->lead_time
        ]);

        return redirect()->route('analisis.index')
            ->with('success', 'Analisis inventori berhasil dibuat');
    }

    public function show(Analisis $analisis)
    {
        $analisis->load('barang');
        return view('analisis.show', compact('analisis'));
    }

    public function destroy(Analisis $analisis)
    {
        $analisis->delete();
        return redirect()->route('analisis.index')
            ->with('success', 'Analisis berhasil dihapus');
    }
}