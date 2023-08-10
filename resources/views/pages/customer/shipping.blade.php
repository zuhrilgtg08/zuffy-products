@extends('layouts.frontend.main')
@section('content')
    <div class="container" style="padding-top: 6.5rem; padding-bottom: 5rem;">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-lg-4">
                        <a href="{{ route('keranjang.list') }}" 
                            class="text-decoration-none btn btn-primary rounded-pil my-4">
                            <i class="fas fa-fw fa-arrow-alt-circle-left"></i>
                            Back to Cart List
                        </a>
                    </div>
                    <div class="col-lg-8">
                        <h2 class="text-center my-4">Add Shipping Data</h2>
                    </div>
                </div>
            </div>
            @if (session()->has('fail'))
                <div class="alert col-lg-8 my-3 alert-danger alert-dismissible fade show" role="alert">
                    {{ session('fail') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-xl-5 col-lg-5">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center my-3">List Order Detail</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Name
                                <span>{{ $alamat->user->name ?? auth()->user()->name }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Email
                                <span>{{ $alamat->user->email ?? auth()->user()->email }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Phone
                                <span>{{ $alamat->user->phone ?? auth()->user()->phone }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Total Quantity
                                <span>{{ $quantity }} Item</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Total Price Product
                                <span>@currency($total_amount)</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Service Shipping
                                <span class="paket-ongkir">Service</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total Payment</strong>
                                    <strong>
                                        <p class="mb-0">(Including Shipping)</p>
                                    </strong>
                                </div>
                                <span><strong class="total-harga">Rp. 0</strong></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center my-3">Add Shipping</h5>
                        <form action="{{ route('shipping.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="total_amount" value="{{ $total_amount }}" id="total_amount">
                            <div class="row justify-content-between">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="province_id" class="form-label">Choose Province</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"><i class="fas fa-fw fa-plane"></i></span>
                                                    <select name="province_id" id="province_id" 
                                                        class="form-select @error('province_id') is-invalid @enderror">
                                                        <option selected disabled>Province</option>
                                                        @if ($alamat === null)
                                                            @foreach ($provinsi as $data)
                                                                <option value="{{ $data->id }}">{{ $data->name_province }}</option>
                                                            @endforeach
                                                        @else
                                                            @foreach ($provinsi as $item)
                                                                <option value="{{ $alamat->provinsi_id ?? $item->id }}" selected>{{ $item->name_province }}</option>
                                                            @endforeach
                                                        @endif
                                                        
                                                    </select>
                                                    @error('province_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="destination_id" class="form-label">Choose City</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"><i class="fas fa-fw fa-city"></i></span>
                                                    <select name="destination_id" id="destination_id"
                                                        class="form-select @error('destination_id') is-invalid @enderror">
                                                        @if ($alamat === null)
                                                            <option>City</option>
                                                        @else
                                                            @foreach ($kota as $item)
                                                                <option value="{{ $alamat->kota_id ?? $item->id }}" selected>{{ $item->nama_kab_kota }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('destination_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="courier" class="form-label">Choose Courier</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"><i class="fas fa-fw fa-tractor"></i></span>
                                                    <select name="courier" id="courier"
                                                        class="form-select @error('courier') is-invalid @enderror">
                                                        <option selected disabled>Courier</option>
                                                        <option value="jne">JNE</option>
                                                        <option value="pos">POS INDONESIA</option>
                                                        <option value="tiki">TIKI</option>
                                                    </select>
                                                    @error('courier')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="weight" class="form-label">Total Weight Product</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"><i class="fas fa-fw fa-weight"></i></span>
                                                    <input type="hidden" name="weight" id="weight-value" value="{{ $weight }}"/>
                                                    <input type="text" id="weight" class="form-control text-primary font-bold" 
                                                        value="{{ $weight / 1000 }} Kg" disabled />
                                                    @error('weight')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="layanan_ongkir" class="form-label">Choose Services</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text"><i class="fas fa-fw fa-walking"></i></span>
                                                    <select name="layanan_ongkir" id="layanan_ongkir" 
                                                        class="form-select @error('layanan_ongkir') is-invalid @enderror">
                                                        <option selected disabled>Services</option>
                                                    </select>
                                                    @error('layanan_ongkir')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="harga_ongkir" class="form-label">List Price Shipping</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Rp.</span>
                                                    <select name="harga_ongkir" id="harga_ongkir"
                                                        class="form-select @error('harga_ongkir') is-invalid @enderror">
                                                        <option selected disabled>Price</option>
                                                    </select>
                                                    @error('harga_ongkir')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Address :</label>
                                        <textarea class="form-control" placeholder="Write Address" id="alamat" style="height: 100px" name="alamat"
                                            required>{{ $alamat->keterangan_alamat ?? '-'}}</textarea>
                                    </div>
                                    <div class="my-3 text-end">
                                        <button type="submit" class="btn btn-success w-25">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/vendors/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('select[name="province_id"]').on('change', function() {
                    let provinces = $(this).val();
                    if(provinces) {
                        $.ajax({
                            type: "GET",
                            url: "/data/city/" + provinces,
                            dataType: "json",
                            success: function (response) {
                                $('select[name="destination_id"]').empty();
                                $.each(response, function(key, value) {
                                    $('select[name="destination_id"]').append(
                                        '<option value="'+ value.id +'">' + value.nama_kab_kota + '</option>'
                                    );
                                });
                            }
                        });
                    } else {
                        $('select[name="destination_id"]').empty();
                    }
                });

            $('select[name="courier"]').on('change', function() {
                    let destination = $("select[name=destination_id]").val();
                    let courier = $("select[name=courier]").val();
                    let weight = $("input[name=weight]").val();

                    if(courier) {
                        jQuery.ajax ({
                            url:"/destination="+destination+"&weight="+weight+"&courier="+courier,
                            type:'GET',
                            dataType:'json',
                            success:function(response) {
                                $('select[name="harga_ongkir"]').empty();
                                $('select[name="layanan_ongkir"]').empty();
                                $('.total-harga').empty();
                                response = response[0];
                                    $.each(response.costs, function(key, value) {
                                        let cost = value.cost[0];
                                        $('select[name="harga_ongkir"]').append('<option value="'+ cost.value + '">' + ' Rp. ' + cost.value + '</option>');
                                        $('select[name="layanan_ongkir"]').append('<option value="'+ value.service + ' : ' + cost.etd + ' (days) '+'">' + value.service + ' - ' + value.description + ' : ' + cost.etd + ' (days) ' + '</option>');
                                    });
                                const total_amount = $('#total_amount').val();
                                let costKurir = response.costs[0].cost[0].value;
                                let paketOngkir = `${response.costs[0].service} : ${response.costs[0].cost[0].etd} (days)`;
                                $('.cost-ongkir').html(`Rp. ${costKurir}`);
                                $('.paket-ongkir').html(paketOngkir);
                                $('.total-harga').html(`Rp. ${parseInt(costKurir) + parseInt(total_amount)}`);
                            }
                        });
                    }else {
                        $('select[name="harga_ongkir"]').empty();
                        $('select[name="layanan_ongkir"]').empty();
                    }
                });

            $('select[name="harga_ongkir"]').on('change', function(){
                    let services = $(this).val();
                    const total_amount = $('#total_amount').val();
                    $('.cost-ongkir').html(`Rp. ${services}`);
                    $('.total-harga').html(`Rp. ${parseInt(services) + parseInt(total_amount)}`);
                });

            $('select[name="layanan_ongkir"]').on('change', function(){
                let paketOngkir = $(this).val();
                $('.paket-ongkir').html(paketOngkir);
            });
        });
    </script>
@endsection