@extends('layouts.app', ['title' => 'Transaksi Baru'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Transaksi Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('transaksi.store') }}" method="POST" id="form-transaksi">
            @csrf
            
            @if(request('resep_id'))
            <input type="hidden" name="id_resep" value="{{ request('resep_id') }}">
            <div class="alert alert-info">
                Transaksi ini berdasarkan resep. <a href="{{ route('resep.show', request('resep_id')) }}">Lihat resep</a>
            </div>
            @endif
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tgl" class="form-label">Tanggal Transaksi</label>
                        <input type="date" class="form-control @error('tgl') is-invalid @enderror" 
                               id="tgl" name="tgl" value="{{ old('tgl', date('Y-m-d')) }}" required>
                        @error('tgl')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="payment" class="form-label">Metode Pembayaran</label>
                        <select class="form-select @error('payment') is-invalid @enderror" 
                                id="payment" name="payment" required>
                            <option value="">Pilih Metode</option>
                            <option value="cash" {{ old('payment') == 'cash' ? 'selected' : '' }}>Tunai</option>
                            <option value="transfer" {{ old('payment') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                            <option value="debit" {{ old('payment') == 'debit' ? 'selected' : '' }}>Kartu Debit</option>
                            <option value="credit" {{ old('payment') == 'credit' ? 'selected' : '' }}>Kartu Kredit</option>
                        </select>
                        @error('payment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <hr>
            
            <h5 class="mb-3">Daftar Obat</h5>
            
            <div id="obat-container">
                @if(request('resep_id'))
                    @foreach($resep->resepItems as $index => $item)
                    <div class="obat-item mb-3 border p-3 rounded" data-index="{{ $index }}">
                        <input type="hidden" name="obat[{{ $index }}][id_barang]" value="{{ $item->id_barang }}">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Obat</label>
                                <input type="text" class="form-control" value="{{ $item->barang->nama_barang }}" readonly>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" class="form-control jumlah" 
                                       name="obat[{{ $index }}][jumlah]" min="1" 
                                       value="{{ $item->jumlah }}" required>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Harga Satuan</label>
                                <input type="number" class="form-control harga-satuan" 
                                       value="{{ $item->barang->harga }}" readonly>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Subtotal</label>
                                <input type="text" class="form-control subtotal" 
                                       value="{{ number_format($item->jumlah * $item->barang->harga, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            
            @if(!request('resep_id'))
            <button type="button" id="tambah-obat" class="btn btn-sm btn-outline-primary mb-3">
                <i class="fas fa-plus"></i> Tambah Obat
            </button>
            @endif
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                  id="catatan" name="catatan" rows="2">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Ringkasan Pembayaran</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total:</span>
                                <span id="total-text">Rp 0</span>
                                <input type="hidden" id="total-bayar" name="total_bayar" value="0">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-2">
                                <i class="fas fa-save"></i> Simpan Transaksi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let obatCounter = {{ request('resep_id') ? count($resep->resepItems) : 0 }};
        
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
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Harga Satuan</label>
                            <input type="text" class="form-control harga-satuan" readonly>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Subtotal</label>
                            <input type="text" class="form-control subtotal" readonly>
                            <button type="button" class="btn btn-sm btn-danger hapus-obat mt-2">
                                <i class="fas fa-trash"></i> Hapus
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
            hitungTotal();
        });
        
        // Pilih obat
        $(document).on('change', '.select-obat', function() {
            const harga = $(this).find(':selected').data('harga');
            const item = $(this).closest('.obat-item');
            item.find('.harga-satuan').val(harga);
            
            const jumlah = item.find('.jumlah').val();
            if (jumlah) {
                hitungSubtotal(item);
            }
        });
        
        // Hitung saat jumlah diubah
        $(document).on('input', '.jumlah', function() {
            const item = $(this).closest('.obat-item');
            hitungSubtotal(item);
        });
        
        // Fungsi hitung subtotal
        function hitungSubtotal(item) {
            const harga = parseFloat(item.find('.harga-satuan').val()) || 0;
            const jumlah = parseFloat(item.find('.jumlah').val()) || 0;
            const subtotal = harga * jumlah;
            
            item.find('.subtotal').val(formatRupiah(subtotal));
            hitungTotal();
        }
        
        // Fungsi hitung total
        function hitungTotal() {
            let total = 0;
            
            $('.obat-item').each(function() {
                const harga = parseFloat($(this).find('.harga-satuan').val()) || 0;
                const jumlah = parseFloat($(this).find('.jumlah').val()) || 0;
                total += harga * jumlah;
            });
            
            $('#total-text').text('Rp ' + formatRupiah(total));
            $('#total-bayar').val(total);
        }
        
        // Format rupiah
        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        
        // Hitung total awal jika ada resep
        @if(request('resep_id'))
        hitungTotal();
        @endif
    });
</script>
@endpush