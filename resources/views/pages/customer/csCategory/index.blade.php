@extends('layouts.frontend.main')

@section('styles')
    <style>
        .cs-card:hover {
            transform: scale(1.1);
            transition: all ease .3s;
        }
    </style>
@endsection

@section('content')
    <div id="projects" class="filter bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="h2-heading">Products that we're proud of</h2>
                </div> 
            </div> 
            <div class="row">
                <div class="col-lg-12">
                    <div class="button-group filters-button-group">
                        <button class="button is-checked" data-filter="*">All</button>
                        <div class="row justify-content-center">
                            @foreach ($listCategory as $filter)
                                <div class="col-lg-3">
                                    <button class="button" data-filter=".{{ $filter->slug }}">
                                        {{ $filter->name_category }}
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div> 
                    <div class="grid">
                        @foreach ($product as $item)
                            <div class="element-item {{ $item->category->slug }} cs-card">
                                <a href="{{ route('product.detail', $item->uuid) }}">
                                    @if ($item->image_product)
                                        <img class="card-img-top border-0" src="{{ asset('storage/' . $item->image_product) }}" 
                                            alt="alternative" height="200"> 
                                    @else
                                        <img class="card-img-top" src="{{ asset('assets/frontend/images/404.svg') }}"
                                            alt="alternative" height="200">
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div> 
        </div> 
    </div> 
@endsection