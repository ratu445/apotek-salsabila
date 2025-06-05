@extends('layouts.app', ['title' => 'Manajemen Pengguna'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Pengguna</h5>
        <a href="{{ route('pengguna.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pengguna
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>No. HP</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penggunas as $pengguna)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pengguna->nama_pengguna }}</td>
                        <td>{{ $pengguna->username }}</td>
                        <td>{{ $pengguna->no_hp }}</td>
                        <td>
                            @if($pengguna->level_user == 1)
                                <span class="badge bg-primary">Apoteker</span>
                            @elseif($pengguna->level_user == 2)
                                <span class="badge bg-info">Asisten Apoteker</span>
                            @elseif($pengguna->level_user == 3)
                                <span class="badge bg-success">Kasir</span>
                            @else
                                <span class="badge bg-secondary">Admin Gudang</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('pengguna.edit', $pengguna->id_pengguna) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($pengguna->id_pengguna != Auth::id())
                                <form action="{{ route('pengguna.destroy', $pengguna->id_pengguna) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data pengguna</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection