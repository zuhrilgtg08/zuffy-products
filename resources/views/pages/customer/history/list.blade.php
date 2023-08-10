@extends('layouts.frontend.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/simple-datatables/style.css') }}">
@endsection
@section('content')
    <div class="container" style="padding-top: 6.5rem; padding-bottom: 5rem;">
        <div class="row justify-content-center">
            <h2 class="text-center my-4">Yout History List</h2>
            <div class="col-xl-12 my-5">
                <table class="table table-lg-table-hover text-center" id="table-history">
                    <thead class="text-white bg-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price Product</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($list as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->product->name_product }}</td>
                                <td>{{ $item->quantity }} Item</td>
                                <td>@currency($item->product->price_product * $item->quantity)</td>
                                <td><span class="badge bg-success">{{ $item->status }}</span></td>
                                <td>
                                    <a href="{{ route('history.print', $item->checkout->id) }}"
                                        target="_blank"
                                        class="btn btn-danger btn-sm rounded-pill text-decoration-none">
                                        <i class="fas fa-fw fa-file-pdf"></i>
                                    </a>
                                    <a href="{{ route('history.detail', $item->checkout->uuid) }}" class="btn btn-primary btn-sm rounded-pill text-decoration-none">
                                        <i class="fas fa-fw fa-info-circle"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/backend/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
            let table = document.querySelector('#table-history');
            let dataTable = new simpleDatatables.DataTable(table);
    </script>
@endsection