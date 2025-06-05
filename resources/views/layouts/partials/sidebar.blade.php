<!-- Sidebar -->
<div class="bg-dark border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-light bg-primary py-3">
        <i class="fas fa-clinic-medical mr-2"></i> Pharmacy System
    </div>
    <div class="list-group list-group-flush">
        <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action bg-dark text-light">
            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
        </a>
        
        @can('manage-inventory')
        <a href="{{ route('barang.index') }}" class="list-group-item list-group-item-action bg-dark text-light">
            <i class="fas fa-pills mr-2"></i> Daftar Obat
        </a>
        <a href="{{ route('kategori.index') }}" class="list-group-item list-group-item-action bg-dark text-light">
            <i class="fas fa-tags mr-2"></i> Kategori Obat
        </a>
        <a href="{{ route('supplier.index') }}" class="list-group-item list-group-item-action bg-dark text-light">
            <i class="fas fa-truck mr-2"></i> Supplier
        </a>
        @endcan
        
        @can('manage-prescriptions')
        <a href="{{ route('resep.index') }}" class="list-group-item list-group-item-action bg-dark text-light">
            <i class="fas fa-file-prescription mr-2"></i> Resep
        </a>
        @endcan
        
        @can('manage-transactions')
        <a href="{{ route('transaksi.index') }}" class="list-group-item list-group-item-action bg-dark text-light">
            <i class="fas fa-cash-register mr-2"></i> Transaksi
        </a>
        @endcan
        
        @can('view-reports')
        <div class="dropdown">
            <a class="list-group-item list-group-item-action bg-dark text-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-chart-bar mr-2"></i> Laporan
            </a>
            <ul class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item text-light" href="{{ route('laporan.stok') }}">Laporan Stok</a></li>
                <li><a class="dropdown-item text-light" href="{{ route('laporan.penjualan') }}">Laporan Penjualan</a></li>
                <li><a class="dropdown-item text-light" href="{{ route('laporan.expired') }}">Obat Kadaluarsa</a></li>
            </ul>
        </div>
        @endcan
        
        @can('manage-users')
        <a href="{{ route('pengguna.index') }}" class="list-group-item list-group-item-action bg-dark text-light">
            <i class="fas fa-users-cog mr-2"></i> Manajemen Pengguna
        </a>
        @endcan
    </div>
</div>