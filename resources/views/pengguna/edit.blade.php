@extends('layouts.app', ['title' => 'Edit Pengguna'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Data Pengguna</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('pengguna.update', $pengguna->id_pengguna) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama_pengguna" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama_pengguna') is-invalid @enderror" 
                           id="nama_pengguna" name="nama_pengguna" value="{{ old('nama_pengguna', $pengguna->nama_pengguna) }}" required>
                    @error('nama_pengguna')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" 
                           id="username" name="username" value="{{ old('username', $pengguna->username) }}" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Password (Kosongkan jika tidak diubah)</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" 
                           id="password_confirmation" name="password_confirmation">
                </div>
            </div>
            
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                          id="alamat" name="alamat" rows="2">{{ old('alamat', $pengguna->alamat) }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="no_hp" class="form-label">No. HP</label>
                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                           id="no_hp" name="no_hp" value="{{ old('no_hp', $pengguna->no_hp) }}" required>
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="level_user" class="form-label">Role</label>
                    <select class="form-select @error('level_user') is-invalid @enderror" 
                            id="level_user" name="level_user" required>
                        <option value="">Pilih Role</option>
                        <option value="1" {{ old('level_user', $pengguna->level_user) == 1 ? 'selected' : '' }}>Apoteker</option>
                        <option value="2" {{ old('level_user', $pengguna->level_user) == 2 ? 'selected' : '' }}>Asisten Apoteker</option>
                        <option value="3" {{ old('level_user', $pengguna->level_user) == 3 ? 'selected' : '' }}>Kasir</option>
                        <option value="4" {{ old('level_user', $pengguna->level_user) == 4 ? 'selected' : '' }}>Admin Gudang</option>
                    </select>
                    @error('level_user')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection