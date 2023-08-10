@extends('layouts.dashboard.main-dashboard', [
    'sbCheckout' => true,
    'sbSubMenuCheckout' => true,
    'sbListCheckout' => 'data.checkout'
])

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/simple-datatables/style.css') }}">
@endsection

@section('main-breadcrumb')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Customer Checkout Data</h3>
                    <p class="text-subtitle text-muted">List Data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/manage_dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Checkouts</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-dashboard')
    <section class="section">
        <div class="col-lg-12">
            <div class="row justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-xl-6 col-lg-6">
                                <h3 class="text-gray-900">List Data Checkouts</h3>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <a href="{{ route('admin.checkout.print') }}" class="btn rounded-pill btn-danger float-end">
                                    <i class="fas fa-fw fa-file-pdf"></i>
                                    Print Data
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table-checkout">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Id Order</th>
                                    <th>Product</th>
                                    <th>Timestamp</th>
                                    <th>Status Payment</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php $no = 1; @endphp
                                @foreach ($checkouts as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ substr($item->checkout->uuid, 24) }}</td>
                                        <td>{{ $item->product->name_product }}</td>
                                        <td>{{ date('d-m-Y',strtotime($item->checkout->created_at)) }}</td>
                                        <td><span class="badge bg-success">{{ $item->checkout->payment_status }}</span></td>
                                        <td>
                                            <a href="{{ route('admin.checkout.detail', $item->checkout->uuid) }}"
                                                class="btn btn-sm btn-dark rounded-pill">
                                                <i class="fas fa-fw fa-info"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table = document.querySelector('#table-checkout');
        let dataTable = new simpleDatatables.DataTable(table);
    </script>
@endsection