@extends('layouts.dashboard.main-dashboard', ['sbActive' => 'dashboard'])

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/simple-datatables/style.css') }}"/>
@endsection

@section('main-breadcrumb')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Dashboard</h3>
                    <p class="text-subtitle text-muted">Main Data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/manage_dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Main Data</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-dashboard')
    <section class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldCategory"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Categories</h6>
                                    <h6 class="font-extrabold mb-0">{{ $data['categories'] }} Data</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Users</h6>
                                    <h6 class="font-extrabold mb-0">{{ $data['user'] }} Data</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldDiscovery"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Prooducts</h6>
                                    <h6 class="font-extrabold mb-0">{{ $data['product'] }} Data</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldWork"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Workers</h6>
                                    <h6 class="font-extrabold mb-0">{{ $data['worker'] }} Data</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-around">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Grafik</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-data"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-header">
                            <h4>Latest Comments</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg text-center" id="reviews">
                                    <thead>
                                        <tr>
                                            <th>Profile</th>
                                            <th>Name</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviews as $item)
                                            <tr>
                                                <td>
                                                    @if ($item->user->image_profile)
                                                    <img src="{{ asset('storage/' . $item->user->image_profile) }}" class="rounded-circle"
                                                        width="30" height="30" alt="profile" />
                                                    @else
                                                        <img src="{{ asset('assets/frontend/images/profile.svg') }}" class="rounded-circle" 
                                                            width="30" height="30" alt="profile" />
                                                    @endif
                                                </td>
                                                <td>{{ $item->user->username }}</td>
                                                <td>
                                                    <p class="mb-0">
                                                        {{ $item->coments }}
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/vendors/apexcharts/apexcharts.js') }}"></script>
    <script>
        let item = {{ Js::from($chart) }}
        let optionsBar = {
            annotations: {
                position: 'back'
            },
            dataLabels: {
                enabled:false
            },
            chart: {
                type: 'bar',
                height: 300
            },
            fill: {
                opacity:1
            },
            plotOptions: {
            },
            series: [{
                name: 'data',
                data: item,
            }],
            colors: '#435EBE',
            xaxis: {
                categories: ["User","Categories","Worker","Product","Rating","Order"],
            },
        }

        let chartBar = new ApexCharts(document.querySelector("#chart-data"), optionsBar);
        chartBar.render();
    </script>
    <script src="{{ asset('assets/backend/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
            let table = document.querySelector('#reviews');
            let dataTable = new simpleDatatables.DataTable(table);
    </script>
@endsection