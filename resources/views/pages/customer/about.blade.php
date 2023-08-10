@extends('layouts.frontend.main')

@section('styles')
    <style>
        .image-about img{
            margin-left: 3rem;
        }

        .text-about {
            margin-top: 9rem;
        } 
    </style>
@endsection

@section('content')
    <!-- About -->
    <div id="about-1" class="basic-1" style="padding-top: 6.5rem;">
        <div class="container">
            <div class="row">
                <div class="col-xl-7">
                    <div class="image-container">
                        <img class="img-fluid" src="{{ asset('assets/frontend/images/about.svg') }}" alt="alternative">
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="text-container">
                        <h2>Zuffy-Store<br>
                            <span>stylish and efficient sites</span>
                        </h2>
                        <p>
                            Hello and welcome to Zuffy-Store, the place to find a wide variety of
                            the best products for every taste and chance.
                        </p>
                        <p>
                            We strictly check the quality of our goods,
                            working only with trusted suppliers so that you only
                            receive the highest quality products.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about-2" class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="text-about">
                        <h2>Zuffy-Store<br>
                            <span>stylish and efficient sites</span>
                        </h2>
                        <p>
                            We believe in high quality and exceptional customer service. 
                            But most importantly, 
                            we believe shopping is a right, not a luxury. 
                        </p>
                        <p>
                            So we strive to deliver the best products at the most affordable prices, 
                            and ship them to you regardless of where you are located.
                        </p>
                    </div>
                </div>
                <div class="col-xl-7">
                   <div class="image-about">
                     <img class="img-fluid" src="{{ asset('assets/frontend/images/header-landing.png') }}" alt="alternative">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection