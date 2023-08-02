@extends('layouts.frontend.main')

@section('styles')
    <style>
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
        }

        .rate {
            display: inline-block;
            border: 0;
        }
        
        .rate > input {
            display: none;
        }
      
        .rate > label {
            float: right;
        }
        
        .rate > label:before {
            display: inline-block;
            font-size: 2rem;
            font-style: normal;
            font-weight: 900;
            padding: .3rem .2rem;
            margin: 0;
            cursor: pointer;
            font-family: 'Font Awesome\ 5 Free';
            content: "\f005"; 
        }
        
        .rate .half:before {
            content: "\f089 "; 
            position: absolute;
            padding-right: 0;
        }
   
        input:checked ~ label, 
        label:hover, label:hover ~ label 
        { color: #deb217; } 
        
        input:checked + label:hover, input:checked ~ label:hover, 
        input:checked ~ label:hover ~ label, 
        label:hover ~ input:checked ~ label 
        { color: #c59b08; }
    </style>
@endsection

@section('content')
    <div class="basic-1" style="padding-top: 7rem;">
        <div class="container">
            <div class="row justify-content-center mt-3">
                @if (session()->has('success'))
                    <div class="alert col-lg-8 my-3 alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }} 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-xl-5">
                    <div class="card border-0">
                        @if ($data->image_product)
                            <img src="{{ asset('storage/' . $data->image_product) }}" alt="img-product"
                                class="card-img-top img-fluid" style="max-height: 300px;" />
                        @else
                            <img src="{{ asset('assets/frontend/images/404.svg') }}" alt="img-product"
                                class="card-img-top img-fluid" />
                        @endif
                        <ul class="list-group list-group-flush mt-3">
                            <li class="list-group-item">Category :
                                <span class="badge bg-success">
                                    {{ $data->category->name_category }}
                                </span>
                            </li>
                            <li class="list-group-item">Weight :
                                <span class="badge bg-warning text-dark">{{ $data->weight_product / 1000 }} Gram</span>
                            </li>
                            <li class="list-group-item">Harga :
                                <span class="badge bg-primary">@currency($data->price_product)</span>
                            </li>
                            <li class="list-group-item">Stock :
                                <span class="badge bg-danger">
                                    @stock($data->stock_product) Barang
                                </span>
                            </li>
                            <li class="list-group-item">Worker :
                                <span class="badge bg-dark">
                                    {{ $data->worker->fullname }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-7">
                    <div class="card border-0">
                        <div class="card-body">
                            <h2 class="card-title">{{ $data->name_product }}</h2>
                            <p class="card-text">{!! $data->desc_product !!}</p>
                            @auth
                                <form action="" method="" class="{{ (auth()->user()->status_type == 'admin') ? 'd-none' : '' }}">
                                    <div class="row mt-3">
                                        <div class="col-xl-3">
                                            <input type="number"
                                                class="form-control text-center @error('quantity') is-invalid @enderror"
                                                name="quantity"
                                                value="{{ old('quantity', ($data->stock_product > 0) ? '1' : '0') }}"
                                                max="{{ $data->stock_product }}" min="1" />
                                            @error('quantity')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-xl-3">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#rating-modal">
                                                <i class="fas fa-fw fa-star text-warning"></i>
                                                Add Rating
                                            </button>
                                        </div>
                                        <div class="col-xl-4">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-fw fa-cart-arrow-down"></i>
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endauth
                            <div class="modal fade" id="rating-modal" tabindex="-1" aria-labelledby="rating-modal"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title fs-5" id="exampleModalLabel">Add rating
                                                <span class="text-danger">
                                                    {{ $data->name_product }}
                                                </span>
                                            </h2>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('add.review') }}" method="POST">
                                            <input type="hidden" name="product_id" value="{{ $data->id }}" />
                                            
                                            @csrf
                                            <div class="modal-body">
                                                @if (!$review->isEmpty())
                                                    <fieldset class="rate">
                                                        @foreach ($review as $item)
                                                            <input type="radio" id="rating5" name="rating" value="5" {{ ($item->rating == 5) ? 'checked' : null }}/><label for="rating5"></label>
                                                            <input type="radio" id="rating4.5" name="rating" value="4.5" {{ ($item->rating == 4.5) ? 'checked' : null }}/><label class="half" for="rating4.5"></label>
                                                            <input type="radio" id="rating4" name="rating" value="4" {{ ($item->rating == 4) ? 'checked' : null }}/><label for="rating4"></label>
                                                            <input type="radio" id="rating3.5" name="rating" value="3.5" {{ ($item->rating == 3.5) ? 'checked' : null }}/><label class="half" for="rating3.5"></label>
                                                            <input type="radio" id="rating3" name="rating" value="3" {{ ($item->rating == 3) ? 'checked' : null }}/><label for="rating3"></label>
                                                            <input type="radio" id="rating2.5" name="rating" value="2.5" {{ ($item->rating == 2.5) ? 'checked' : null }}/><label class="half" for="rating2.5"></label>
                                                            <input type="radio" id="rating2" name="rating" value="2" {{ ($item->rating == 2) ? 'checked' : null }}/><label for="rating2"></label>
                                                            <input type="radio" id="rating1.5" name="rating" value="1.5" {{ ($item->rating == 1.5) ? 'checked' : null }}/><label class="half" for="rating1.5"></label>
                                                            <input type="radio" id="rating1" name="rating" value="1" {{ ($item->rating == 1) ? 'checked' : null }}/><label for="rating1"></label>
                                                            <input type="radio" id="rating0.5" name="rating" value="0.5" {{ ($item->rating == 0.5) ? 'checked' : null }}/><label class="half" for="rating0.5"></label>
                                                        @endforeach
                                                    </fieldset>
                                                @else
                                                    <fieldset class="rate">
                                                        <input type="radio" id="rating5" name="rating" value="5" /><label for="rating5"></label>
                                                        <input type="radio" id="rating4.5" name="rating" value="4.5" /><label class="half" for="rating4.5"></label>
                                                        <input type="radio" id="rating4" name="rating" value="4" /><label for="rating4"></label>
                                                        <input type="radio" id="rating3.5" name="rating" value="3.5" /><label class="half" for="rating3.5"></label>
                                                        <input type="radio" id="rating3" name="rating" value="3" /><label for="rating3"></label>
                                                        <input type="radio" id="rating2.5" name="rating" value="2.5" /><label class="half" for="rating2.5"></label>
                                                        <input type="radio" id="rating2" name="rating" value="2" /><label for="rating2"></label>
                                                        <input type="radio" id="rating1.5" name="rating" value="1.5" /><label class="half" for="rating1.5"></label>
                                                        <input type="radio" id="rating1" name="rating" value="1" /><label for="rating1"></label>
                                                        <input type="radio" id="rating0.5" name="rating" value="0.5" /><label class="half" for="rating0.5"></label>
                                                    </fieldset>
                                                @endif
                                                <div class="my-3">
                                                    <textarea name="coments" rows="6" class="form-control" maxlength="200" required placeholder="Your Comment...">{{ old('coments', $komentar) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection