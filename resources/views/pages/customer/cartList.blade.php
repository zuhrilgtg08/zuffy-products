@extends('layouts.frontend.main')

@section('styles')
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
            @if (session()->has('success'))
                <div class="alert col-lg-8 my-3 alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('fail'))
                <div class="alert col-lg-8 my-3 alert-danger alert-dismissible fade show" role="alert">
                    {{ session('fail') }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
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
                                <tbody>
                                    @foreach ($list as $item)
                                        <tr>
                                            <td class="col-3">
                                                @if ($item->product->image_product)
                                                    <img src="{{ asset('storage/' . $item->product->image_product) }}"
                                                    width="100" height="100" alt="img-product" />
                                                @else
                                                    <img src="{{ asset('assets/frontend/images/404.svg') }}" alt="img-product" 
                                                        width="100" height="100" class="img-thumbnail" />
                                                @endif
                                                Product 1
                                            </td>
                                            <td>
                                                <form action="{{ route('keranjang.update', $item->id) }}" method="POST" 
                                                    class="d-inline" id="cart-form">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="box">
                                                        <button type="button" class="btn btn-sm minus bg-transparent 
                                                            {{ ($item->quantity >= $item->product->stock_product) ? 'd-none' : ''}}">
                                                            <i class="fas fa-fw fa-minus"></i></button>
                                                            <input type="number" name="quantity" value="{{ $item->quantity }}" 
                                                                min="1" max="{{ $item->product->stock_product }}"
                                                                {{ ($item->quantity >= $item->product->stock_product) ? 'disabled' : ''}}/>
                                                        <button type="button" class="btn btn-sm plus bg-transparent 
                                                            {{ ($item->quantity >= $item->product->stock_product) ? 'd-none' : ''}}">
                                                            <i class="fas fa-fw fa-plus"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="box">
                                                    @currency($item->product->price_product)
                                                    <span class="fs-5 p-auto">
                                                        <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm bg-transparent">
                                                                <i class="fas fa-fw fa-times text-danger fs-4 text-center"></i>
                                                            </button>
                                                        </form>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Quantity
                                <span>{{ $qty ?? 0 }} Item</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total Payment</strong>
                                    <strong>
                                        <p class="mb-0">(Not Including Shipping)</p>
                                    </strong>
                                </div>
                                <span><strong>@currency($amount ?? Rp. 0)</strong></span>
                            </li>
                        </ul>
                    
                        <div class="mx-auto text-center {{ $list->isEmpty() ? 'd-none' : '' }}">
                            <a href="{{ route('shipping.create') }}" class="btn btn-solid-reg btn-lg btn-block">
                                Go to add shipping
                            </a>
                        </div>
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
                let $form = $(this).closest('form');
                let $input = $(this).parent().find('input');
                let count = parseInt($input.val()) - 1;
                let timer;
                if(timer) {clearTimeout(timer);}
                count = count < 1 ? 1 : count; 
                $input.val(count); 
                $input.change(); 
                timer = setTimeout($form.submit(), 100);
                return false; 
            }); 

            $('.plus').click(function () { 
                let $form = $(this).closest('form');
                let $input=$(this).parent().find('input'); 
                $input.val(parseInt($input.val()) + 1); 
                $input.change(); 
                $form.submit();
                return false; 
            });
        });
    </script>
@endsection