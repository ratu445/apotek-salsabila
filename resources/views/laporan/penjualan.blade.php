@extends('layouts.app', ['title' => 'Laporan Penjualan'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Laporan Penjualan</h5>
        <div>
            <form action="{{ route('laporan.penjualan') }}" method="GET" class="form-inline">
                <div class="row g-2">
                    <div class="col-md-5">
                        <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-5">
                        <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div>
            <a href="{{ route('laporan.penjualan.export') }}?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ route('laporan.penjualan.print') }}?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}" class="btn btn-primary" target="_blank">
                <i class="fas fa-print"></i> Cetak
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(request('start_date') && request('end_date'))
        <div class="alert alert-info mb-4">
            Menampilkan data dari tanggal {{ request('start_date') }} sampai {{ request('end_date') }}
        </div>
        @endif
        
        <div class="table-responsive">
            <table class="table table-hover table-bordered datatable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>No. Transaksi</th>
                        <th>Total</th>
                        <th>Metode Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaksi->tgl }}</td>
                        <td>TRX-{{ str_pad($transaksi->id_permintaan, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($transaksi->payment) }}</td>
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
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total Penjualan:</th>
                        <th colspan="3">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
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