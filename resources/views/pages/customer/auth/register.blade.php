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
                @if (session()->has('fail'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('fail') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="col-xl-7">
                <img src="{{ asset('assets/frontend/images/register.gif') }}" class="img-fluid" alt="bg-art">
            </div>
            <div class="col-xl-5">
                <h3 class="auth-title my-3 text-center">Please Register Account 🪄</h3>

                <div class="container">
                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-fw fa-ghost"></i></span>
                                <input type="text" id="username" name="username" class="form-control 
                                @error('username') is-invalid @enderror" placeholder="Username" 
                                value="{{ old('username') }}" required />
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-fw fa-envelope"></i></span>
                                <input type="email" id="email" name="email" class="form-control 
                                    @error('email') is-invalid @enderror" placeholder="Your Email" 
                                    value="{{ old('email') }}" required/>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="create-password" class="form-label">Create Password</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-fw fa-key"></i></span>
                                <input type="password" id="create-password" name="create_password" class="form-control" 
                                    placeholder="Create Password" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm Password</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-fw fa-check-circle"></i></span>
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Confirm Password" required/>
                            </div>
                        </div>
                        <div class="mx-auto text-center">
                            <button type="submit" class="btn btn-primary btn-block shadow-lg w-50">
                                <i class="fas fa-fw fa-sign-in-alt"></i> Register
                            </button>
                        </div>
                    </form>
                    <div class="text-center mt-3 text-lg fs-3">
                        <p class="text-gray-600">Have an account?
                            <a href="{{ route('login') }}" class="font-bold">Signin</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection