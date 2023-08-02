@extends('layouts.frontend.main')

@section('styles')
    <style>
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
            font-size: 1rem;
            font-style: normal;
            font-weight: 900;
            padding: 0 0 2rem .2rem;
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

        .popular-card {
            display: block;
            top: 0px;
            position: relative;
            border-radius: 4px;
            margin: 12px;
            z-index: 0;
            overflow: hidden;
        
            &:hover {
                transition: all 0.2s ease-out;
                box-shadow: 0px 4px 8px rgba(38, 38, 38, 0.2);
                top: -4px;
                border: 1px solid #cccccc;
            }
            
            &:before {
                content: "";
                position: absolute;
                z-index: -1;
                top: -16px;
                right: -16px;
                height: 32px;
                width: 32px;
                border-radius: 32px;
                transform: scale(2);
                transform-origin: 50% 50%;
                transition: transform 0.15s ease-out;
            }
            
            &:hover:before {
                transform: scale(2.15);
            }
        }
    </style>
@endsection

@section('content')
    <div class="container" style="padding-top: 6.5rem; padding-bottom: 5rem;">
        <div class="row justify-content-center">
            <h3 class="text-center my-2">2023 Best Selling Products - updated weekly.</h3>
            @foreach ($popular as $data)
                <div class="col-xl-4 my-3">
                    <div class="card border-0 my-4 popular-card" style="box-shadow: 0px 2px 4px rgba(38, 38, 38, 0.2);">
                        <a href="{{ route('product.detail', $data->uuid) }}" class="text-decoration-none">
                            <div class="card-content">
                                @if ($data->image_product)
                                    <img src="{{ asset('storage/' . $data->image_product) }}" alt="product" 
                                        class="card-img-top img-fluid" style="height: 200px;"/>
                                @else
                                    <img src="{{ asset('assets/frontend/images/404.svg') }}" alt="product" 
                                        class="card-img-top img-fluid" />
                                @endif
                                <div class="card-body">
                                    <h5 class="fw-bolder card-title text-capitalize">{{ $data->name_product }} <br>
                                        <p class="text-muted fs-6">By 
                                            <span class="text-primary fst-italic">{{ $data->worker->username }}</span>
                                            In <span class="text-muted fs-6">{{ $data->category->name_category }}</span>
                                        </p>
                                    </h5>
                                    <p class="card-text fw-bolder">@currency($data->price_product)</p>
                                    <fieldset class="rate">
                                        <input type="radio" id="rating5" {{ ($data->rating == 5) ? 'checked' : null }}/><label for="rating5"></label>
                                        <input type="radio" id="rating4.5" {{ ($data->rating == 4.5 || $data->rating == 4.75 || $data->rating == 4.25) ? 'checked' : null }}/><label class="half" for="rating4.5"></label>
                                        <input type="radio" id="rating4" {{ ($data->rating == 4) ? 'checked' : null }}/><label for="rating4"></label>
                                        <input type="radio" id="rating3.5" {{ ($data->rating == 3.5 || $data->rating == 3.75 || $data->rating == 3.25) ? 'checked' : null }}/><label class="half" for="rating3.5"></label>
                                        <input type="radio" id="rating3" {{ ($data->rating == 3) ? 'checked' : null }}/><label for="rating3"></label>
                                        <input type="radio" id="rating2.5" {{ ($data->rating == 2.5) ? 'checked' : null }}/><label class="half" for="rating2.5"></label>
                                        <input type="radio" id="rating2" {{ ($data->rating == 2) ? 'checked' : null }}/><label for="rating2"></label>
                                        <input type="radio" id="rating1.5" {{ ($data->rating == 1.5) ? 'checked' : null }}/><label class="half" for="rating1.5"></label>
                                        <input type="radio" id="rating1" {{ ($data->rating == 1) ? 'checked' : null }}/><label for="rating1"></label>
                                        <input type="radio" id="rating0.5" {{ ($data->rating == 0.5) ? 'checked' : null }}/><label class="half" for="rating0.5"></label>
                                        ({{ $data->rating }})
                                    </fieldset>
                                    <form action="" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="float-end btn btn-danger">
                                            <i class="fas fa-fw fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection