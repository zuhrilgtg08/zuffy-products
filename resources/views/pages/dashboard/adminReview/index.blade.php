@extends('layouts.dashboard.main-dashboard', [
    'sbMaster' => true,
    'sbMasterSubMenu' => true,
    'sbList' => 'data.review'
])

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('main-breadcrumb')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Review Products</h3>
                    <p class="text-subtitle text-muted">List Product Reviews</p>
                    @if (session()->has('remove'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('remove') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/manage_dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Reviews</li>
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
                                <h3 class="text-gray-900">List Products Review</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table-review">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Rating</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                               @php $no = 1; @endphp
                                @foreach ($list as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ substr($item->uuid, 24) }}</td>
                                        <td>{{ $item->name_product }}</td>
                                        <td>{{ $item->category->name_category }}</td>
                                        <td>{{ $item->rating }} <i class="fas fa-fw fa-star text-warning"></i></td>
                                        <td>
                                            <a href="{{ route('admin.reviews.detail', $item->uuid) }}" class="btn btn-sm btn-dark rounded-pill">
                                                <i class="fas fa-fw fa-info-circle"></i> Detail
                                            </a>
                                            <form action="{{ route('admin.reviews.destroy', $item->id) }}" method="POST" class="d-inline" id="form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm basic-delete btn-danger rounded-pill my-1">
                                                    <i class="fas fa-fw fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
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
        let table = document.querySelector('#table-review');
        let dataTable = new simpleDatatables.DataTable(table);
    </script>
    <script src="{{ asset('assets/backend/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        // Sweetalert Simple
         let btnDelete = document.getElementsByClassName('basic-delete');
         Array.from(btnDelete).forEach((el) => {
            el.addEventListener('click', () => {
                let form = el.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            })
         })
    </script>
@endsection