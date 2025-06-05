@extends('layouts.app', ['title' => 'Laporan Obat Kadaluarsa'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Laporan Obat Kadaluarsa</h5>
        <div>
            <a href="{{ route('laporan.expired.export') }}" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ route('laporan.expired.print') }}" class="btn btn-primary" target="_blank">
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
                        <th>Stok</th>
                        <th>Tanggal Kadaluarsa</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangs as $barang)
                    <tr class="{{ \Carbon\Carbon::parse($barang->expired_date)->isPast() ? 'table-danger' : '' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori->nama_kategori }}</td>
                        <td>{{ $barang->stok }} {{ $barang->keterangan }}</td>
                        <td>{{ $barang->expired_date->format('d-m-Y') }}</td>
                        <td>
                            @if(\Carbon\Carbon::parse($barang->expired_date)->isPast())
                                <span class="badge bg-danger">Kadaluarsa</span>
                            @elseif(\Carbon\Carbon::parse($barang->expired_date)->diffInDays() <= 30)
                                <span class="badge bg-warning">Akan Kadaluarsa</span>
                            @else
                                <span class="badge bg-success">Aman</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('barang.show', $barang->id_barang) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Detail
                            </a>
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