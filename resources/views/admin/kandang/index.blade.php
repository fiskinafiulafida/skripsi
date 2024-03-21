@extends('layouts.admin')

@section('title', 'Kandang Ayam')

@section('pageHeading')
<h1 class="h3 mb-0 text-gray-800">Data Kandang Ayam</h1>
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
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kandang Ayam</h6>
    </div>
    <div class="card-body">
        <!-- Pesan data berhasil disimpan -->
        @if (session('success') == 'Data Berhasil Disimpan!')
        <div class="alert alert-success">
            Data Berhasil Disimpan!
        </div>
        @elseif (session('error') == 'Data Gagal Disimpan!')
        <div class="alert alert-danger">
            Data Gagal Disimpan!
        </div>
        @endif
        <div class="table-responsive">
            <a href="{{ route('kandangAdmin.create') }}" class="btn btn-md btn-primary mb-3">Tambah Data Kandang Ayam</a>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kandang</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kandang</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($kandangs as $kandang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kandang->nama_kandang }}</td>
                        <td>{{ $kandang->keterangan_kandang }}</td>
                        <td class="text-center">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kandangAdmin.destroy', $kandang->id) }}" method="POST">
                                <a href="{{ route('kandangAdmin.edit', $kandang->id) }}" class="btn btn-info btn-circle btn-lg"><i class="fas fa-info-circle"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-circle btn-lg"> <i class="fas fa-trash"></i></button>
                                </a>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <div class="alert alert-danger">
                        Data Kandang Ayam belum Tersedia.
                    </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection