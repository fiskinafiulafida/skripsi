@extends('layouts.admin')

@section('title', 'Generate Peramalan Produksi Telur Ayam')

@section('pageHeading')
<h1 class="h3 mb-0 text-gray-800">Generate Peramalan Produksi Telur Ayam</h1>
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

@section('row1')
<div class="col-lg-4 mb-3">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <a href="user">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <h6> A. Reset Terlebih dahulu sebelum melakukan perhitungan</h6>
                            <h6> B. Pilih Data Kandang Ayam</h6>
                            <h6> C. Pilih Nilai Alpha</h6>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@section('row2')
<form action="/getData" method="post" class="d-flex flex-wrap ml-4">
    @csrf
    <div class="col-md-5 mb-2">
        <label class="font-weight-bold" for="selectKandang">Pilih Kandang Ayam</label>
        <select name="namakandang_id" id="selectKandang" class="form-control @error('namakandang_id') is-invalid @enderror">
            <option value="{{ old('namakandang_id') }}"> Kandang Ayam </option>
            @foreach ($kandangs as $kandang)
            <option value="{{ $kandang->id }}">{{ $kandang->nama_kandang }}</option>
            @endforeach
        </select>
        @error('namakandang_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3 mb-2">
        <label class="font-weight-bold" for="selectAlpha">Pilih Alpha</label>
        <select name="alpha" id="selectAlpha" class="form-control @error('alpha') is-invalid @enderror">
            <option value="{{ old('alpha') }}"> alpha </option>
            <option value="0.1">0.1</option>
            <option value="0.2">0.2</option>
            <option value="0.3">0.3</option>
            <option value="0.4">0.4</option>
            <option value="0.5">0.5</option>
            <option value="0.6">0.6</option>
            <option value="0.7">0.7</option>
            <option value="0.8">0.8</option>
            <option value="0.9">0.9</option>
        </select>
        @error('alpha')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-3 mb-2 mt-4">
        <button type="submit" class="btn btn-success">Proses Perhitungan</button>
    </div>
</form>

<form action="/clear-records" method="post" class="d-flex flex-wrap">
    @csrf
    <div class="col-lg-3 mb-2 mt-4">
        <button type="submit" class="btn btn-danger">Reset</button>
    </div>
</form>

@endsection



@section('container')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Peramalan Produksi Telur Ayam</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Periode</th>
                        <th>Data Aktual</th>
                        <th>at</th>
                        <th>bt</th>
                        <th>ft</th>
                    </tr>
                </thead>
                <tfoot>
                    @foreach ($peramalan as $item)
                    <tr>
                        <th>{{ $item->periode }}</th>
                        <th>{{ $item->aktual }}</th>
                        <th>{{ round($item->a) }}</th>
                        <th>{{ round($item->b) }}</th>
                        <th>{{ round($item->f) }}</th>
                    </tr>
                    @endforeach
                </tfoot>
                <tbody>
                    @forelse ($dataAktual as $dataAktual)
                    <tr>
                        <!-- <td>{{ $loop->iteration }}</td>
                        <td>{{ $dataAktual->jumlah}}</td>
                        <td>{{ $penghitunganTelur}}</td> -->
                    </tr>
                    @empty
                    <div class="alert alert-danger">
                        Data Peramalan belum Tersedia.
                    </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</script>
@endsection