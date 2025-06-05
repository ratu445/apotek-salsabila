<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Permintaan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function stokBarang()
    {
        $barangs = Barang::with(['kategori', 'supplier'])
            ->orderBy('stok', 'asc')
            ->get();
            
        return view('laporan.stok', compact('barangs'));
    }

    public function permintaan(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        $permintaans = Permintaan::with(['barangPermintaans.barang', 'resep'])
            ->whereBetween('tgl', [$startDate, $endDate])
            ->orderBy('tgl', 'asc')
            ->get();

        return view('laporan.permintaan', compact('permintaans', 'startDate', 'endDate'));
    }

    public function analisisInventori()
    {
        $analisis = Analisis::with('barang')
            ->orderBy('id_barang')
            ->get();

        return view('laporan.analisis', compact('analisis'));
    }
}