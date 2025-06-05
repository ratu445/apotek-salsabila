@extends('layouts.app', ['title' => 'Daftar Resep'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Resep</h5>
        <a href="{{ route('resep.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Resep
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
                        <th>No. Resep</th>
                        <th>Tanggal</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Diagnosa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reseps as $resep)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>RES-{{ str_pad($resep->id_resep, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $resep->tgl_resep->format('d-m-Y') }}</td>
                        <td>{{ $resep->nama_pasien }}</td>
                        <td>{{ $resep->pengguna->nama_pengguna }}</td>
                        <td>{{ Str::limit($resep->diagnosa, 50) }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('resep.show', $resep->id_resep) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('resep.edit', $resep->id_resep) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('resep.destroy', $resep->id_resep) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus resep ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data resep</td>
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