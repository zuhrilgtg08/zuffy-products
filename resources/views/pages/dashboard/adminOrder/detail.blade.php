@extends('layouts.dashboard.main-dashboard', [
    'sbCheckout' => true,
    'sbSubMenuCheckout' => true,
    'sbListCheckout' => 'data.checkout'
])

@section('main-breadcrumb')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Checkout Data</h3>
                    <p class="text-subtitle text-muted">Detail Data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/manage_dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.checkout.list') }}">Checkouts</a></li>
                            <li class="breadcrumb-item active">Detail</li>
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
                <div class="col-xl-12 col-lg-12">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="row justify-content-around">
                                <h4 class="card-title fw-bolder my-3 text-center">Invoice : <span class="text-primary">#{{ $data[0]->uuid }}</span></h4>
                                <div class="col-lg-6">
                                    <ul class="list-unstyled">
                                        <li class="text-black">Nama : {{ $data[0]->nama_user }}</li>
                                        <li class="text-black">Provinsi : {{ $data[0]->provinsi }}</li>
                                        <li class="text-black">Kota/Kabupaten : {{ $data[0]->kota }}</li>
                                        <li class="text-black">Alamat : {{ $data[0]->alamat_tujuan }}</li>
                                        <li class="text-black">No Telp : {{ $data[0]->phone }} </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <ul class="list-unstyled">
                                        <li class="text-black">Total Berat : {{ $data[0]->total_berat / 1000 }} gram</li>
                                        <li class="text-black">Kurir : {{ strtoupper($data[0]->kurir) }}</li>
                                        <li class="text-black">Layanan : {{ $data[0]->layanan_ongkir }}</li>
                                        <li class="text-black">Harga Ongkir : @currency($data[0]->harga_ongkir)</li>
                                        <li class="text-black">Total Harga Pembelian : @currency($data[0]->amount)</li>
                                    </ul>
                                </div>
                            </div>
                            <table class="table table-lg table-hover text-center" width="100%">
                                <thead class="bg-success text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Name Product</th>
                                        <th>Quantity</th>
                                        <th>Price Product</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama_product }}</td>
                                            <td>{{ $item->jumlah }} Item</td>
                                            <td>@currency($item->harga_product)</td>
                                            <td>
                                                @if($item->order_status === 'PENDING')
                                                    <span class="badge bg-warning text-dark">{{ $item->order_status }}</span>
                                                @else
                                                    <span class="badge bg-success">{{ $item->order_status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row justify-content-center">
                                <div class="col-xl-7">
                                    <h6 class="text-primary mt-2">{{ $data[0]->bukti_pembayaran }}</h6>
                                </div>
                                <div class="col-xl-5">
                                    <h3 class="text-primary fw-bold text-center">Total : @currency($data[0]->harga_ongkir + $data[0]->amount)</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection