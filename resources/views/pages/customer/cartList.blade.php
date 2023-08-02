@extends('layouts.frontend.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/simple-datatables/style.css') }}" />
    <style>
        .btn:focus{
            box-shadow:none !important;
        }   

        .box{
            margin-top:2.5rem;
        }

        input{
            height:30px;
            width: 100px;
            text-align: center;
            font-size: 20px;
            border:1px solid #ddd;
            border-radius:5px;
            display: inline-block;
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
    <div class="container" style="padding-top: 6.5rem; padding-bottom: 5rem;">
        <div class="row justify-content-center">
            <h2 class="text-center my-4">Cart List</h2>
            <div class="col-xl-8 col-lg-8">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-lg text-center table-striped">
                                <thead class="text-white" style="background-color: #FF5574;">
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    <tr>
                                        <td class="col-3">
                                            <img src="https://placehold.co/100x100" alt="" class="img-thumbnail" width="100" height="100"/>
                                            Product 1
                                        </td>
                                        <td>
                                            <form action="" method="POST" class="d-inline">
                                                <div class="box">
                                                    <button type="button" class="btn btn-sm minus bg-transparent"><i class="fas fa-fw fa-minus"></i></button>
                                                    <input type="number" name="quantity" value="1" min="1" />
                                                    <button type="button" class="btn btn-sm plus bg-transparent"><i class="fas fa-fw fa-plus"></i></button>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <div class="box">
                                                Rp.20.000
                                                <span class="fs-5 p-auto">
                                                    <form action="" method="POST" class="d-inline">
                                                        <button type="submit" class="btn btn-sm bg-transparent">
                                                            <i class="fas fa-fw fa-times text-danger fs-4 text-center"></i>
                                                        </button>
                                                    </form>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="card shadow border-0">
                    <div class="card-header py-3">
                        <h5 class="mb-0 text-center">Detail Cart Amount</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Products
                                {{-- <span>Rp. 100.000</span> --}}
                                <span>Rp. 0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Quantity
                                {{-- <span>1 Item</span> --}}
                                <span>0 Item</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total Payment</strong>
                                    <strong>
                                        <p class="mb-0">(Not Including Shipping)</p>
                                    </strong>
                                </div>
                                <span><strong>Rp. 0</strong></span>
                                {{-- <span><strong>Rp. 0</strong></span> --}}
                            </li>
                        </ul>
                    
                        {{-- <div class="mx-auto text-center">
                            <a href="" class="btn btn-solid-reg btn-lg btn-block">
                                Go to add shipping
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/vendors/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.minus').click(function () {
                let $input = $(this).parent().find('input');
                let count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count; 
                $input.val(count); 
                $input.change(); 
                return false; 
            }); 

            $('.plus').click(function () { 
                var $input=$(this).parent().find('input'); 
                $input.val(parseInt($input.val()) + 1); 
                $input.change(); 
                return false; 
            });
        });
    </script>
    {{-- <script src="{{ asset('assets/backend/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
            let table = document.querySelector('#list-cart');
            let dataTable = new simpleDatatables.DataTable(table);
    </script> --}}
@endsection