<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek1 - @yield('title')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @stack('styles')
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark text-white" id="sidebar-wrapper" style="width: 250px;">
            <div class="sidebar-heading text-center py-4">
                <h4>Apotek1</h4>
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
                
                <a href="{{ route('barang.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-box me-2"></i>Data Barang
                </a>
                
                <a href="{{ route('kategori.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-tags me-2"></i>Kategori Barang
                </a>
                
                <a href="{{ route('supplier.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-truck me-2"></i>Supplier
                </a>
                
                <a href="{{ route('resep.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-file-prescription me-2"></i>Resep
                </a>
                
                <a href="{{ route('permintaan.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-shopping-cart me-2"></i>Permintaan
                </a>
                
                <a href="{{ route('analisis.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-chart-line me-2"></i>Analisis Inventori
                </a>
                
                <div class="dropdown">
                    <a class="list-group-item list-group-item-action bg-dark text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-file-alt me-2"></i>Laporan
                    </a>
                    <ul class="dropdown-menu bg-dark">
                        <li><a class="dropdown-item text-white" href="{{ route('laporan.stok') }}">Laporan Stok</a></li>
                        <li><a class="dropdown-item text-white" href="{{ route('laporan.permintaan') }}">Laporan Permintaan</a></li>
                        <li><a class="dropdown-item text-white" href="{{ route('laporan.analisis') }}">Laporan Analisis</a></li>
                    </ul>
                </div>
                
                @if(auth()->user()->level_user == 1 || auth()->user()->level_user == 4)
                <a href="{{ route('pengguna.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-users me-2"></i>Pengguna
                </a>
                @endif
            </div>
        </div>
        
        <!-- Page Content -->
        <div id="page-content-wrapper" style="width: calc(100% - 250px);">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-sm btn-dark" id="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->nama_pengguna }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <div class="container-fluid px-4 py-3">
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Toggle sidebar
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        
        // Enable tooltips
        $(function () {
            $('[data-bs-toggle="tooltip"]').tooltip()
        });
    </script>
    
    @stack('scripts')
</body>
</html>