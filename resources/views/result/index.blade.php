@extends('layouts.admin')

@section('title', 'Peramalan Produksi Telur Ayam')

@section('pageHeading')
<h1 class="h3 mb-0 text-gray-800">Hasil Peramalan Produksi Telur Ayam</h1>
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
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <h6> 1. Reset Terlebih Dahulu Sebelum Melakukan Peramalan</h6>
                        <h6> 2. Pilih Bulan yang Akan di Ramalkan</h6>
                        <h6> 3. Klik Proses Peramalan</h6>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('row2')
<form action="/getResult" method="post" class="d-flex flex-wrap ml-4">
    @csrf
    <div class="col-md-7 mb-2">
        <label class="font-weight-bold" for="selectBulan">Pilih Bulan</label>
        <select name="bulan" id="selectBulan" class="form-control" style="width: 200px;">
            @foreach ($availableMonths as $month)
            <option value="{{ $month['value'] }}" {{ $month['disabled'] ? 'disabled' : '' }} class=" {{ $month['disabled'] ? 'bg-dark' : '' }}">
                {{ $month['name'] }}
            </option>
            @endforeach
        </select>
        @error('bulan')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-3 mb-4 mt-4">
        <button type="submit" class="btn btn-success">Proses Peramalan</button>
    </div>
</form>
<!-- untuk menghapus data yang awal sebelumnya -->
<form action="/clearResult" method="post" class="d-flex flex-wrap ml-4">
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
        <h6 class="m-0 font-weight-bold text-primary">Hasil Data Peramalan Produksi Telur Ayam</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Hasil Prediksi</th>
                    </tr>
                </thead>
                <tfoot>
                    @foreach ($data as $item)
                    @php
                    $monthIndex = ($latestMonthIndex + $item->m) % 12;
                    $month = $months[$monthIndex];
                    $year = $latestYear + floor(($latestMonthIndex + $item->m) / 12);
                    @endphp
                    <tr>
                        <th>{{ $month }} {{ $year }}</th>
                        <th>{{ number_format(round($item->ft), 0, ',', '.') }}</th>
                    </tr>
                    @endforeach
                </tfoot>
            </table>
        </div>
        <div class="col-lg-12 mb-4">
            <div class="card-body">
                <div id="chart"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    let m = [];
    let ft = [];

    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    const latestMonthIndex = {{ $latestMonthIndex }};
    const latestYear = {{ $latestYear }};

    function generateChart(data) {
        const tempDataValue = [];
        const tempDataXaxis = [];

        for (const iterator of data) {
            tempDataValue.push(Number(iterator.ft).toFixed());
            let monthIndex = Number(latestMonthIndex) + Number(iterator.m);
            let year = latestYear + Math.floor((Number(latestMonthIndex) + Number(iterator.m)) / 12);
            let month = months[monthIndex];
            tempDataXaxis.push(`${month} ${year}`);
        }

        return {
            value: tempDataValue,
            xaxis: tempDataXaxis,
        };
    };

    fetch("/filter")
        .then((response) => response.json())

        .then((data) => {
            var grafikPeramalan = generateChart(data);


            var options = {
                series: [{
                    name: "Hasil Prediksi",
                    data: grafikPeramalan.value
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                title: {
                    text: 'Grafik Hasil Peramalan Produksi Telur Ayam',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'],
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: grafikPeramalan.xaxis,
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }).catch((error) => console.error('Error fetching data:', error));
    console.log("Test Data?", m);
</script>
@endsection