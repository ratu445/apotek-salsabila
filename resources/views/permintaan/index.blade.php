@extends('layouts.app')

@section('title', 'Data Permintaan')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Permintaan</h6>
            <a href="{{ route('permintaan.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Permintaan
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No. Permintaan</th>
                            <th>Tanggal</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Resep</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permintaans as $permintaan)
                        <tr>
                            <td>PM-{{ str_pad($permintaan->id_permintaan, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $permintaan->tgl->format('d/m/Y') }}</td>
                            <td>Rp {{ number_format($permintaan