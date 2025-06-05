@extends('layouts.app')

@section('title', 'Tambah Resep')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Resep</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('resep.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="id_pengguna" class="form-label">Apoteker</label>
                            <select class="form-select @error('id_pengguna') is-invalid @enderror" 
                                id="id_pengguna" name="id_pengguna" required>
                                <option value="">Pilih Apoteker</option>
                                @foreach($penggunas as $pengguna)
                                    <option value="{{ $pengguna->id_pengguna }}" {{ old('id_pengguna') == $pengguna->id_pengguna ? 'selected' : '' }}>
                                        {{ $pengguna->nama_pengguna }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_pengguna')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="nama_pasien" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control @error('nama_pasien') is-invalid @enderror" 
                                id="nama_pasien" name="nama_pasien" value="{{ old('nama_pasien') }}" required>
                            @error('nama_pasien')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_resep" class="form-label">Tanggal Resep</label>
                            <input type="date" class="form-control @error('tgl_resep') is-invalid @enderror" 
                                id="tgl_resep" name="tgl_resep" value="{{ old('tgl_resep', date('Y-m-d')) }}" required>
                            @error('tgl_resep')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="diagnosa" class="form-label">Diagnosa</label>
                            <input type="text" class="form-control @error('diagnosa') is-invalid @enderror" 
                                id="diagnosa" name="diagnosa" value="{{ old('diagnosa') }}">
                            @error('diagnosa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                id="catatan" name="catatan" rows="2">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <hr>
                        <h5 class="mb-3">Item Resep</h5>
                        
                        <div id="item-container">
                            <div class="item-row row mb-3">
                                <div class="col-md-5">
                                    <select class="form-select" name="items[0][id_barang]" required>
                                        <option value="">Pilih Barang</option>
                                        @foreach($barangs as $barang)
                                            <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }} ({{ $barang->keterangan }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="items[0][jumlah]" placeholder="Jumlah" min="1" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="items[0][aturan_pakai]" placeholder="Aturan Pakai" required>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-sm remove-item" disabled>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <button type="button" id="add-item" class="btn btn-secondary btn-sm mb-3">
                            <i class="fas fa-plus"></i> Tambah Item
                        </button>
                        
                        <hr>
                        <button type="submit" class="btn btn-primary">Simpan Resep</button>
                        <a href="{{ route('resep.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let itemCount = 1;
        
        // Tambah item
        $('#add-item').click(function() {
            const newItem = `
                <div class="item-row row mb-3">
                    <div class="col-md-5">
                        <select class="form-select" name="items[${itemCount}][id_barang]" required>
                            <option value="">Pilih Barang</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }} ({{ $barang->keterangan }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="items[${itemCount}][jumlah]" placeholder="Jumlah" min="1" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="items[${itemCount}][aturan_pakai]" placeholder="Aturan Pakai" required>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm remove-item">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            
            $('#item-container').append(newItem);
            itemCount++;
        });
        
        // Hapus item
        $(document).on('click', '.remove-item', function() {
            if ($('.item-row').length > 1) {
                $(this).closest('.item-row').remove();
            }
        });
    });
</script>
@endpush