@extends('layouts.admin')

@section('title', 'Data User')

@section('pageHeading')
<h1 class="h3 mb-0 text-gray-800">Create Data User</h1>
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
            <form action="{{ route('user.store') }}" method="POST" class="register-form" id="register-form">
                @csrf
                <div class="form-group">
                    <label class="font-weight-bold">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama">

                    <!-- error message untuk name -->
                    @error('name')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukkan email">

                    <!-- error message untuk email -->
                    @error('email')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Masukkan password">

                    <!-- error message untuk password -->
                    @error('password')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Role User</label><br>

                    <select name="role" id="role" class="btn btn-light @error('role') is-invalid @enderror" value="{{ old('role') }}" data-toggle="dropdown" style="width:1420px">
                        <option selected></option>
                        <option value="admin">Admin</option>
                        <option value="owner">Owner</option>
                    </select>
                    @error('role')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
            </form>
        </div>
    </div>
</div>
@endsection