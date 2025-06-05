@extends('layouts.app')

@section('title', 'Data Resep')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Resep</h6>
            <a href="{{ route('resep.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Resep
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No. Resep</th>
                            <th>Tanggal</th>
                            <th>Nama Pasien</th>
                            <th>Apoteker</th>
                            <th>Jumlah Item</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reseps as $resep)
                        <tr>
                            <td>RES-{{ str_pad($resep->id_resep, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $resep->tgl_resep->format('d/m/Y') }}</td>
                            <td>{{ $resep->nama_pasien }}</td>
                            <td>{{ $resep->pengguna->nama_pengguna }}</td>
                            <td>{{ $resep->items->count() }}</td>
                            <td>
                                <a href="{{ route('resep.show', $resep->id_resep) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('resep.destroy', $resep->id_resep) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection