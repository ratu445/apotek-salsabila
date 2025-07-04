@extends('layouts.app', ['title' => 'Edit Obat'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Data Obat</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kode_barang" class="form-label">Kode Obat</label>
                    <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" 
                           id="kode_barang" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" required>
                    @error('kode_barang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="nama_barang" class="form-label">Nama Obat</label>
                    <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" 
                           id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                    @error('nama_barang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select class="form-select @error('id_kategori') is-invalid @enderror" 
                            id="id_kategori" name="id_kategori" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori', $barang->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="id_supplier" class="form-label">Supplier</label>
                    <select class="form-select @error('id_supplier') is-invalid @enderror" 
                            id="id_supplier" name="id_supplier" required>
                        <option value="">Pilih Supplier</option>
                        @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id_supplier }}" {{ old('id_supplier', $barang->id_supplier) == $supplier->id_supplier ? 'selected' : '' }}>
                            {{ $supplier->nama_supplier }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_supplier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="keterangan" class="form-label">Satuan</label>
                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" 
                           id="keterangan" name="keterangan" value="{{ old('keterangan', $barang->keterangan) }}" required>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                           id="harga" name="harga" value="{{ old('harga', $barang->harga) }}" required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                           id="stok" name="stok" value="{{ old('stok', $barang->stok) }}" required>
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="expired_date" class="form-label">Tanggal Kadaluarsa</label>
                    <input type="date" class="form-control @error('expired_date') is-invalid @enderror" 
                           id="expired_date" name="expired_date" value="{{ old('expired_date', $barang->expired_date ? $barang->expired_date->format('Y-m-d') : '') }}">
                    @error('expired_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="produsen" class="form-label">Produsen</label>
                    <input type="text" class="form-control @error('produsen') is-invalid @enderror" 
                           id="produsen" name="produsen" value="{{ old('produsen', $barang->produsen) }}">
                    @error('produsen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="komposisi" class="form-label">Komposisi</label>
                <textarea class="form-control @error('komposisi') is-invalid @enderror" 
                          id="komposisi" name="komposisi" rows="3">{{ old('komposisi', $barang->komposisi) }}</textarea>
                @error('komposisi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Obat</label>
                <input type="file" class="form-control @error('gambar') is-invalid @enderror" 
                       id="gambar" name="gambar">
                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                @if($barang->gambar)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Obat" class="img-thumbnail" width="150">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="hapus_gambar" name="hapus_gambar">
                        <label class="form-check-label" for="hapus_gambar">
                            Hapus gambar saat disimpan
                        </label>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                   