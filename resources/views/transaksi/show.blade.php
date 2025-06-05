@extends('layouts.app', ['title' => 'Detail Transaksi'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detail Transaksi #TRX-{{ str_pad($transaksi->id_permintaan, 5, '0', STR_PAD_LEFT) }}</h5>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Tanggal</th>
                        <td>{{ $transaksi->tgl }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($transaksi->status == 3)
                                <span class="badge bg-success">Selesai</span>
                            @elseif($transaksi->status == 2)
                                <span class="badge bg-info">Dikirim</span>
                            @elseif($transaksi->status == 1)
                                <span class="badge bg-warning">Diproses</span>
                            @else
                                <span class="badge bg-secondary">Belum diproses</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Metode Pembayaran</th>
                        <td>{{ ucfirst($transaksi->payment) }}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        @if($transaksi->id_resep)
        <div class="alert alert-info mb-4">
            Transaksi ini berdasarkan resep. <a href="{{ route('resep.show', $transaksi->id_resep) }}">Lihat resep</a>
        </div>
        @endif
        
        <h5 class="mb-3">Daftar Obat</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi->barangPermintaans as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->barang->nama_barang }}</td>
                        <td>{{ $item->jumlah }} {{ $item->barang->keterangan }}</td>
                        <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->jumlah * $item->harga_satuan, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total</th>
                        <th>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <div class="btn-group">
                @if($transaksi->status != 3)
                <form action="{{ route('transaksi.update', $transaksi->id_permintaan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="3">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Tandai Selesai
                    </button>
                </form>
                @endif
                <a href="{{ route('transaksi.print', $transaksi->id_permintaan) }}" class="btn btn-primary" target="_blank">
                    <i class="fas fa-print"></i> Cetak
                </a>
            </div>
        </div>
    </div>
</div>
@endsection