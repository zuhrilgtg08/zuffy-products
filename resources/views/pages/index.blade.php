@extends('layouts.frontend.main')

@section('styles')
    <style>
        .header {
            padding-top: 9rem;
        }

        .text-container {
            margin-top: 5rem;
        }

        .header .image-container img {
            width: 720px;
            height: 600px;
        }
    </style>
@endsection

@section('content')
    <div id="header" class="header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="text-container">
                        <div class="section-title">Welcome to Zuffy-Store eCommerce web</div>
                        <h1 class="h1-large">Zuffy-Store stylish and efficient sites</h1>
                        <form action="{{ route('home') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control" placeholder="Search Now"
                                    value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-fw fa-search"></i>
                                    Search
                                </button>
                            </div>
                        </form>
                        <p class="p-large">
                            The center of fashion and your hobby, Alright great time to shop!
                        </p>
                    </div>
                </div> 
                <div class="col-xl-7">
                    <div class="image-container">
                        <img class="img-fluid" src="{{ asset('assets/frontend/images/home.svg') }}" alt="alternative">
                    </div> 
                </div> 
            </div>
        </div>
    </div> 

    <div class="container">
        <div class="row justify-content-center">
            @if ($data->count())
                <h3 class="mb-5 text-center font-semibold text-primary">Related Products</h3>
                @foreach ($data as $item)
                    <div class="col-xl-4 mb-5">
                        <div class="card shadow border-0">
                            <div class="card-content"> 
                                @if ($item->image_product)
                                    <img src="{{ asset('storage/' . $item->image_product) }}" alt="img-product"
                                        class="card-img-top img-fluid" style="height: 200px;"/>
                                @else
                                    <img src="{{ asset('assets/frontend/images/404.svg') }}" alt="img-product"
                                        class="card-img-top img-fluid"/>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->name_product }}</h5>
                                    <p class="card-text">
                                        {{ $item->excerpt }}
                                    </p>
                                    <p class="card-text">Harga : <span class="badge bg-success">@currency($item->price_product)</span></p>
                                    <a class="btn btn-primary w-50 text-decoration-none" href="{{ route('product.detail', $item->uuid) }}">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12 float-end">
                    {!! $data->links() !!}
                </div>
            @else 
                <h3 class="mb-5 text-center font-semibold text-primary">Sory, Products Not Found!</h3>
            @endif 
        </div>
    </div>

    <div class="slider-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider-container">
                        <div class="swiper-container card-slider">
                            <div class="swiper-wrapper">
                                @foreach ($review as $data)
                                    <div class="swiper-slide">
                                        <div class="card">
                                            <img class="quotes" src="{{ asset('assets/frontend/images/quotes.svg') }}" alt="alternative">
                                            <div class="card-body">
                                                <p class="testimonial-text">{{ $data->comments }}</p>
                                                <div class="details">
                                                    @if ($data->user_image)
                                                        <img class="testimonial-image" src="{{ asset('storage/' . $data->user_image) }}" 
                                                            alt="alternative" />
                                                    @else
                                                        <img class="testimonial-image" src="{{ asset('assets/frontend/images/profile.svg') }}" 
                                                            alt="alternative" />
                                                    @endif
                                                    <div class="text">
                                                        <div class="testimonial-author">{{ $data->user_name ?? '-' }}</div>
                                                        <div class="occupation">{{ $data->user_job ?? '-' }}</div>
                                                    </div> 
                                                </div> 
                                            </div>
                                        </div>
                                    </div> 
                                @endforeach
                            </div> 
    
                            <!-- Add Arrows -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
    </div> 
@endsection