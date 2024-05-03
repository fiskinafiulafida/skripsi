@extends('layouts.pemilik')

@section('title', 'Dashboard Owner')

@section('pageHeading')
<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
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

@section('row1')
<!-- Earnings (Monthly) Card Example -->
<div class="col-lg-6 mb-3">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Kandang Ayam
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> {{ $kandang }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-home fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-lg-6 mb-3">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Data Tahun Produksi Telur Ayam</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tahun}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-history fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('row2')
<!-- Area Chart -->
<div class="col-lg-12 mb-4">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown --><!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Grafik Hasil Produksi Telur Ayam</h6>
            <form action="/filterGrafikowner" method="post" id="formFilter">
                @csrf
                <select name="tahun" id="tahun" class="btn btn-outline-primary @error('tahun') is-invalid @enderror" value="{{ old('namakandang_id') }}" data-toggle="dropdown" style="width: 350px;">
                    <option value="">-- Pilih Tahun Produksi --</option>
                    @foreach ($tahunProduksi as $item)
                    <option value={{ $item->id }}>{{ $item->tahunProduksi }}</option>
                    @endforeach
                </select>
                <select name="kandang" id="kandang" class="btn btn-outline-primary @error('kandang') is-invalid @enderror" value="{{ old('namakandang_id') }}" data-toggle="dropdown" style="width: 350px;">
                    <option value="">-- Pilih Kandang Ayam --</option>
                    @foreach ($kandangAyam as $item)
                    <option value={{ $item->id }}>{{ $item->nama_kandang }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success">Filter data</button>
            </form>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <canvas id="myAreaChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection