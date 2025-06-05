@extends('layouts.app', ['title' => 'Detail Obat'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detail Obat</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Kode Obat</th>
                        <td>{{ $barang->kode_barang }}</td>
                    </tr>
                    <tr>
                        <th>Nama Obat</th>
                        <td>{{ $barang->nama_barang }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $barang->kategori->nama_kategori }}</td>
                    </tr>
                    <tr>
                        <th>Supplier</th>
                        <td>{{ $barang->supplier->nama_supplier }}</td>
                    </tr>
                    <tr>
                        <th>Satuan</th>
                        <td>{{ $barang->keterangan }}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>{{ $barang->stok }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Kadaluarsa</th>
                        <td class="{{ \Carbon\Carbon::parse($barang->expired_date)->isPast() ? 'text-danger' : '' }}">
                            {{ $barang->expired_date ? $barang->expired_date->format('d-m-Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Produsen</th>
                        <td>{{ $barang->produsen ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Komposisi</th>
                        <td>{{ $barang->komposisi ?? '-' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 text-center">
                @if($barang->gambar)
                <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Obat" class="img-fluid rounded mb-3" style="max-height: 300px;">
                @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                    <div class="text-muted">Tidak ada gambar</div>
                </div>
                @endif
            </div>
        </div>
        
        <div class="mt-4">
            <h5 class="mb-3">Analisis Persediaan</h5>
            @if($barang->analisis)
            <div class="row">
                <div class="col-md-4">
                    <div class="card border-primary mb-3">
                        <div class="card-header bg-primary text-white">EOQ</div>
                        <div class="card-body">
                            <h3 class="card-title text-center">{{ number_format($barang->analisis->eoq, 2) }}</h3>
                            <p class="card-text text-center">Economic Order Quantity</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-success mb-3">
                        <div class="card-header bg-success text-white">ROP</div>
                        <div class="card-body">
                            <h3 class="card-title text-center">{{ number_format($barang->analisis->rop, 2) }}</h3>
                            <p class="card-text text-center">Reorder Point</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-info mb-3">
                        <div class="card-header bg-info text-white">Safety Stock</div>
                        <div class="card-body">
                            <h3 class="card-title text-center">{{ $barang->analisis->safety_stok }}</h3>
                            <p class="card-text text-center">Stok Pengaman</p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-warning">Belum ada data analisis persediaan untuk obat ini</div>
            @endif
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <div class="btn-group">
                <a href="{{ route('barang.edit', $barang->id_barang) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('barang.destroy', $barang->id_barang) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection