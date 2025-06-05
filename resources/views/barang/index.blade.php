@extends('layouts.app', ['title' => 'Daftar Obat'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Obat</h5>
        <div>
            <a href="{{ route('barang.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Obat
            </a>
            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                <i class="fas fa-file-import"></i> Import
            </a>
            <a href="{{ route('barang.export') }}" class="btn btn-info">
                <i class="fas fa-file-export"></i> Export
            </a>
        </div>
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
                        <th>Kode</th>
                        <th>Nama Obat</th>
                        <th>Kategori</th>
                        <th>Supplier</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Expired</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $barang)
                    <tr class="{{ \Carbon\Carbon::parse($barang->expired_date)->isPast() ? 'table-danger' : '' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori->nama_kategori }}</td>
                        <td>{{ $barang->supplier->nama_supplier }}</td>
                        <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                        <td>{{ $barang->stok }} {{ $barang->keterangan }}</td>
                        <td>{{ $barang->expired_date ? $barang->expired_date->format('d-m-Y') : '-' }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('barang.show', $barang->id_barang) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('barang.edit', $barang->id_barang) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('barang.destroy', $barang->id_barang) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada data obat</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('barang.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file" class="form-label">Pilih File Excel</label>
                        <input class="form-control" type="file" id="file" name="file" required>
                        <div class="form-text">Format file harus sesuai template</div>
                    </div>
                    <a href="{{ route('barang.download-template') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-download"></i> Download Template
                    </a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
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