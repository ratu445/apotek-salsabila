@extends('layouts.app', ['title' => 'Edit Supplier'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Supplier</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('supplier.update', $supplier->id_supplier) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_supplier" class="form-label">Nama Supplier</label>
                <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror" 
                       id="nama_supplier" name="nama_supplier" value="{{ old('nama_supplier', $supplier->nama_supplier) }}" required>
                @error('nama_supplier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                          id="alamat" name="alamat" rows="2">{{ old('alamat', $supplier->alamat) }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="no_telp" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" 
                           id="no_telp" name="no_telp" value="{{ old('no_telp', $supplier->no_telp) }}" required>
                    @error('no_telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email', $supplier->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="npwp" class="form-label">NPWP</label>
                    <input type="text" class="form-control @error('npwp') is-invalid @enderror" 
                           id="npwp" name="npwp" value="{{ old('npwp', $supplier->npwp) }}">
                    @error('npwp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" 
                           id="keterangan" name="keterangan" value="{{ old('keterangan', $supplier->keterangan) }}">
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('supplier.index') }}" class="btn btn-secondary">
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