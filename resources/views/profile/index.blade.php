@extends('layouts.admin')

@section('title', 'Profile User')

@section('pageHeading')
<h1 class="h3 mb-0 text-gray-800">Profile User</h1>
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
<div class="card shadow mb-4">
    <center>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Hallo, {{ Auth::user()->name }}</h6>
        </div>
    </center>
    <div class="card-body">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-6 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <br>
                            <br>
                            <img src="{{ asset ('Admin/img/undraw_profile.svg')}}" class="rounded" style="width: 100px">
                        </div>
                        <div class=" col-md-8">
                            <div class="card-body p-4">
                                <h6>Information User</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Name</h6>
                                        <p class="text-muted">{{ Auth::user()->name }}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted">{{ Auth::user()->email }}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Role User</h6>
                                        <p class="text-muted">{{ Auth::user()->role }}</p>
                                    </div>
                                </div>
                                <hr class="mt-0 mb-2">
                                <div class="col-12 mb-3">
                                    <a href="{{ route('profile.edit', Auth::user()->id) }}" class="fa fa-edit"> Edit Profile User</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
                                    <a href="{{ route('password.edit', Auth::user()->id) }}"> <i class="fa fa-key" aria-hidden="true"></i>Change Password </a>
                                </div>
                                <hr class="mt-0 mb-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection