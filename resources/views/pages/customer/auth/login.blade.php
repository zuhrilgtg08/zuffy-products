@extends('layouts.frontend.main')
@section('styles')
    <style>
        .auth-content {
            margin-top: 7rem;
            margin-bottom: 5rem;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center auth-content">
            <div class="col-md-8 text-center my-3">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                       {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('fail'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('fail') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="col-xl-7">
                <img src="{{ asset('assets/frontend/images/market.gif') }}" class="img-fluid" alt="bg-art">
            </div>
            <div class="col-xl-5">
                <h1 class="auth-title my-5 text-center">Please Login 👋</h1>

                <div class="container">
                    <form method="POST" action="{{ route('authenticate') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-fw fa-envelope"></i></span>
                                <input type="email" id="email" name="email" class="form-control 
                                    @error('email') is-invalid @enderror" required value="{{ old('email') }}"
                                    placeholder="Your Email" />
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Your Password</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-fw fa-key"></i></span>
                                <input type="password" id="password" name="password" class="form-control" 
                                    placeholder="Your Password" required />
                            </div>
                        </div>
                        <div class="mx-auto text-center">
                            <button type="submit" class="btn btn-primary btn-block shadow-lg mt-3 w-50">
                                <i class="fas fa-fw fa-sign-in-alt"></i> Log in
                            </button>
                        </div>
                    </form>
                    <div class="text-center mt-5 text-lg fs-3">
                        <p class="text-gray-600">Don't have an account? 
                            <a href="{{ route('register') }}" class="font-bold">Signup</a>
                        </p>
                    </div>
                </div>
            </div> 
        </div>
    </div>
@endsection