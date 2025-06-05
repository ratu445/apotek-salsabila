@extends('layouts.app', ['title' => 'Detail Resep'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detail Resep</h5>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">No. Resep</th>
                        <td>RES-{{ str_pad($resep->id_resep, 5, '0', STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ $resep->tgl_resep->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Nama Pasien</th>
                        <td>{{ $resep->nama_pasien }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Dokter</th>
                        <td>{{ $resep->pengguna->nama_pengguna }}</td>
                    </tr>
                    <tr>
                        <th>Diagnosa</th>
                        <td>{{ $resep->diagnosa }}</td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td>{{ $resep->catatan ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <h5 class="mb-3">Daftar Obat</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Aturan Pakai</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resep->resepItems as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->barang->nama_barang }}</td>
                        <td>{{ $item->jumlah }} {{ $item->barang->keterangan }}</td>
                        <td>{{ $item->aturan_pakai }}</td>
                        <td>Rp {{ number_format($item->barang->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->jumlah * $item->barang->harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-end">Total</th>
                        <th>Rp {{ number_format($resep->resepItems->sum(function($item) { return $item->jumlah * $item->barang->harga; }), 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('resep.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <div class="btn-group">
                <a href="{{ route('resep.edit', $resep->id_resep) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('resep.destroy', $resep->id_resep) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus resep ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
                @if(!$resep->permintaan)
                <a href="{{ route('transaksi.create', ['resep_id' => $resep->id_resep]) }}" class="btn btn-primary">
                    <i class="fas fa-cash-register"></i> Proses Transaksi
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection