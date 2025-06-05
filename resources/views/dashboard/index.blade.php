@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
<div class="row">
    <!-- Summary Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Obat</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalObat }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-pills fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Obat Hampir Habis</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $obatHampirHabis }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Obat Kadaluarsa</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $obatExpired }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-times fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Transaksi Hari Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transaksiHariIni }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cash-register fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Transactions -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Transaksi Terakhir</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksiTerakhir as $transaksi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Expiring Medicines -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-danger">Obat Akan Kadaluarsa</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Obat</th>
                                <th>Stok</th>
                                <th>Kadaluarsa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($obatAkanExpired as $obat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $obat->nama_barang }}</td>
                                <td>{{ $obat->stok }}</td>
                                <td class="{{ \Carbon\Carbon::parse($obat->expired_date)->isPast() ? 'text-danger' : '' }}">
                                    {{ $obat->expired_date->format('d-m-Y') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection