@extends('layouts.app', ['title' => 'Tambah Resep'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Tambah Resep Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('resep.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama_pasien" class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control @error('nama_pasien') is-invalid @enderror" 
                           id="nama_pasien" name="nama_pasien" value="{{ old('nama_pasien') }}" required>
                    @error('nama_pasien')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="tgl_resep" class="form-label">Tanggal Resep</label>
                    <input type="date" class="form-control @error('tgl_resep') is-invalid @enderror" 
                           id="tgl_resep" name="tgl_resep" value="{{ old('tgl_resep', date('Y-m-d')) }}" required>
                    @error('tgl_resep')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="diagnosa" class="form-label">Diagnosa</label>
                <textarea class="form-control @error('diagnosa') is-invalid @enderror" 
                          id="diagnosa" name="diagnosa" rows="2">{{ old('diagnosa') }}</textarea>
                @error('diagnosa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea class="form-control @error('catatan') is-invalid @enderror" 
                          id="catatan" name="catatan" rows="2">{{ old('catatan') }}</textarea>
                @error('catatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <hr>
            
            <h5 class="mb-3">Daftar Obat</h5>
            
            <div id="obat-container">
                <!-- Obat akan ditambahkan di sini -->
            </div>
            
            <button type="button" id="tambah-obat" class="btn btn-sm btn-outline-primary mb-3">
                <i class="fas fa-plus"></i> Tambah Obat
            </button>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('resep.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Resep
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let obatCounter = 0;
        
        // Tambah obat
        $('#tambah-obat').click(function() {
            const obatHtml = `
                <div class="obat-item mb-3 border p-3 rounded" data-index="${obatCounter}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Obat</label>
                            <select class="form-select select-obat" name="obat[${obatCounter}][id_barang]" required>
                                <option value="">Pilih Obat</option>
                                @foreach($barangs as $barang)
                                <option value="{{ $barang->id_barang }}" data-harga="{{ $barang->harga }}">
                                    {{ $barang->nama_barang }} (Stok: {{ $barang->stok }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" class="form-control jumlah" name="obat[${obatCounter}][jumlah]" min="1" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Aturan Pakai</label>
                            <input type="text" class="form-control" name="obat[${obatCounter}][aturan_pakai]" required>
                        </div>
                        <div class="col-md-1 mb-3 d-flex align-items-end">
                            <button type="button" class="btn btn-sm btn-danger hapus-obat">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            $('#obat-container').append(obatHtml);
            obatCounter++;
        });
        
        // Hapus obat
        $(document).on('click', '.hapus-obat', function() {
            $(this).closest('.obat-item').remove();
        });
    });
</script>
@endpush