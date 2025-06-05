@extends('layouts.app', ['title' => 'Laporan Stok Obat'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Laporan Stok Obat</h5>
        <div>
            <a href="{{ route('laporan.stok.export') }}" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ route('laporan.stok.print') }}" class="btn btn-primary" target="_blank">
                <i class="fas fa-print"></i> Cetak
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered datatable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Kategori</th>
                        <th>Supplier</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Expired</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangs as $barang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori->nama_kategori }}</td>
                        <td>{{ $barang->supplier->nama_supplier }}</td>
                        <td>{{ $barang->stok }} {{ $barang->keterangan }}</td>
                        <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                        <td class="{{ \Carbon\Carbon::parse($barang->expired_date)->isPast() ? 'text-danger' : '' }}">
                            {{ $barang->expired_date ? $barang->expired_date->format('d-m-Y') : '-' }}
                        </td>
                        <td>
                            @if($barang->stok <= 0)
                                <span class="badge bg-danger">Habis</span>
                            @elseif($barang->stok < 10)
                                <span class="badge bg-warning">Hampir Habis</span>
                            @else
                                <span class="badge bg-success">Tersedia</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.datatable').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json'
            }
        });
    });
</script>
@endpush