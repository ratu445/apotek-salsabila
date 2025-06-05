@extends('layouts.app', ['title' => 'Daftar Transaksi'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Transaksi</h5>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Transaksi Baru
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <div class="table-responsive">
            <table class="table table-hover table-bordered datatable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>No. Transaksi</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Resep</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>TRX-{{ str_pad($transaksi->id_permintaan, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $transaksi->tgl }}</td>
                        <td>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
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
                        <td>
                            @if($transaksi->id_resep)
                                <a href="{{ route('resep.show', $transaksi->id_resep) }}" class="btn btn-sm btn-outline-info">
                                    Lihat Resep
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('transaksi.show', $transaksi->id_permintaan) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($transaksi->status != 3)
                                <form action="{{ route('transaksi.destroy', $transaksi->id_permintaan) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan transaksi ini?')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data transaksi</td>
                    </tr>
                    @endforelse
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
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json'
            }
        });
    });
</script>
@endpush