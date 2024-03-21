@extends('layouts.admin')

@section('title', 'Edit Data Produksi Telur Ayam')

@section('pageHeading')
<h1 class="h3 mb-0 text-gray-800">Edit Data Produksi Telur Ayam</h1>
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
        <a class="nav-link" href="/dashboardAdmin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - User -->
    <li class="nav-item active">
        <a class="nav-link" href="/user">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span></a>
    </li>

    <!-- Nav Item - Kandang Ayam -->
    <li class="nav-item active">
        <a class="nav-link" href="/kandangAdmin">
            <i class="fas fa-home"></i>
            <span>Kandang Ayam</span></a>
    </li>

    <!-- Nav Item - Tahun Produksi Telur-->
    <li class="nav-item active">
        <a class="nav-link" href="/tahunProduksiAdmin">
            <i class="fas fa-history"></i>
            <span>Tahun Produksi Telur </span></a>
    </li>

    <!-- Nav Item - Produksi Telur -->
    <li class="nav-item active">
        <a class="nav-link" href="/produksiTelur">
            <i class="fas fa-chart-line"></i>
            <span>Produksi Telur</span></a>
    </li>

    <!-- Nav Item - Peramalan -->
    <li class="nav-item active">
        <a class="nav-link" href="/peramalanAdmin">
            <i class="fa fa-area-chart"></i>
            <span>Generate Peramalan</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="/result-view">
            <i class="fa fa-book"></i>
            <span>Hasil Peramalan</span></a>
    </li>

    <!-- Nav Item - Laporan
    <li class="nav-item active">
        <a class="nav-link" href="/laporanAdmin">
            <i class="fas fa-book"></i>
            <span>Laporan</span></a>
    </li> -->
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
@endsection

@section('container')
<div class="col-lg-12">
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <form action="{{ route('produksiTelur.update', $produksiTelur->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="font-weight-bold">Kandang Ayam</label><br>
                    <select name="namakandang_id" id="namakandang_id" class="btn btn-light" data-toggle="dropdown" style="width:650px">
                        @foreach ($kandangs as $kandang)
                        <option value="{{ $kandang->id }}" selected>{{ $kandang->nama_kandang }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Bulan Produksi Telur</label><br>
                    <select name="bulan" id="bulan" class="btn btn-light @error('bulan') is-invalid @enderror" value="{{ old('bulan') }}" data-toggle="dropdown" style="width:650px">
                        <option value="">-- Pilih Bulan Produksi --</option>
                        <option value="Januari" {{ $produksiTelur->bulan == 'Januari' ? 'selected' : '' }}>Januari</option>
                        <option value="Februari" {{ $produksiTelur->bulan == 'Februari' ? 'selected' : '' }}>Februari</option>
                        <option value="Maret" {{ $produksiTelur->bulan == 'Maret' ? 'selected' : '' }}>Maret</option>
                        <option value="April" {{ $produksiTelur->bulan == 'April' ? 'selected' : '' }}>April</option>
                        <option value="Mei" {{ $produksiTelur->bulan == 'Mei' ? 'selected' : '' }}>Mei</option>
                        <option value="Juni" {{ $produksiTelur->bulan == 'Juni' ? 'selected' : '' }}>Juni</option>
                        <option value="Juli" {{ $produksiTelur->bulan == 'Juli' ? 'selected' : '' }}>Juli</option>
                        <option value="Agustus" {{ $produksiTelur->bulan == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                        <option value="September" {{ $produksiTelur->bulan == 'September' ? 'selected' : '' }}>September</option>
                        <option value="Oktober" {{ $produksiTelur->bulan == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                        <option value="November" {{ $produksiTelur->bulan == 'November' ? 'selected' : '' }}>November</option>
                        <option value="Desember" {{ $produksiTelur->bulan == 'Desember' ? 'selected' : '' }}>Desember</option>
                    </select>
                    @error('bulan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class=" form-group">
                    <label class="font-weight-bold">Tahun Produksi Telur</label>
                    <br>
                    <select name="tahunProduksi_id" id="tahunProduksi_id" class="btn btn-light" data-toggle="dropdown" style="width:650px">
                        @foreach ($tahunProduksi as $tahun)
                        <option value="{{ $tahun->id }}" selected>{{ $tahun->tahunProduksi }}</option>
                        @endforeach
                    </select>

                </div>


                <div class="form-group">
                    <label class="font-weight-bold">Jumlah Produksi Telur Ayam</label>
                    <input type="text" style="width:650px" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" value="{{ old('jumlah', $produksiTelur->jumlah) }}" placeholder="Masukkan Jumlah Produksi Telur Ayam">
                </div>


                <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                <button type="reset" class="btn btn-md btn-warning">RESET</button>
            </form>
        </div>
    </div>
</div>

@endsection