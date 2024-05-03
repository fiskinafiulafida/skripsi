@extends('layouts.admin')

@section('title', 'Hasil Produksi Telur Ayam')

@section('pageHeading')
<h1 class="h3 mb-0 text-gray-800">Hasil Produksi Telur Ayam</h1>
@endsection

@section('sidebar')
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-egg"></i>
            <i class="fas fa-egg"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Siii <sup>Endog</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/dashboardowner">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Produksi Telur -->
    <li class="nav-item active">
        <a class="nav-link" href="/produksiTelurowner">
            <i class="fas fa-chart-line"></i>
            <span>Produksi Telur</span></a>
    </li>

    <!-- Nav Item - Laporan -->
    <li class="nav-item active">
        <a class="nav-link" href="/hasilPeramalanowner">
            <i class="fas fa-book"></i>
            <span>Hasil Peramalan</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
@endsection

@section('container')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Hasil Produksi Telur Ayam</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-12 mb-4">
            <form action="/filterKandangOWner" method="post">
                @csrf
                <label class="font-weight-bold">Filter Kandang Ayam</label><br>
                <select name="namakandang_id" id="namakandang_id" class="btn btn-outline-primary @error('namakandang_id') is-invalid @enderror" value="{{ old('namakandang_id') }}" data-toggle="dropdown" style="width: 350px;">
                    <option value="">-- Pilih Kandang Ayam --</option>
                    @foreach ($kandangs as $kandang)
                    <option value="{{ $kandang->id }}">{{ $kandang->nama_kandang }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success">Filter Kandang</button>
                <a href="/produksiTelurowner" class="btn btn-success">Tampilkan semua data</a>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kandang</th>
                        <th>Tahun</th>
                        <th>Bulan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Kandang</th>
                        <th>Tahun</th>
                        <th>Bulan</th>
                        <th>Jumlah</th>
                    </tr>
                </tfoot>
                <tbody id="tbody">
                    @forelse ($produksi as $produksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $produksi->kandang->nama_kandang}}</td>
                        <td>{{ $produksi->tahunProduksi->tahunProduksi }}</td>
                        <td>{{ $produksi->bulan }}</td>
                        <!-- <td>{{ $produksi->jumlah }}</td> -->
                        <th>{{ number_format(($produksi->jumlah), 0, ',', '.') }}</th>
                    </tr>
                    @empty
                    <div class="alert alert-danger">
                        Data Produksi belum Tersedia.
                    </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection