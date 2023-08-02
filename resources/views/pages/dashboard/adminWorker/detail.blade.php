@extends('layouts.dashboard.main-dashboard', [
    'sbMaster' => true,
    'sbMasterSubMenu' => true,
    'sbList' => 'data.worker'
])

@section('main-breadcrumb')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Workers</h3>
                    <p class="text-subtitle text-muted">About Worker</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/manage_dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.workers.index') }}">Workers</a></li>
                            <li class="breadcrumb-item active">Detail Worker</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-dashboard')
    <section class="row justify-content-center">
        <div class="col-xl-5">
            <div class="card">
                <div class="card-content">
                    @if ($worker->image_profile_worker)
                        <img class="card-img-top img-fluid" src="{{ asset('storage/' . $worker->image_profile_worker) }}" alt="Card image cap"
                            style="height: 20rem" />
                    @else
                        <img class="card-img-top img-fluid" src="{{ asset('assets/backend/images/samples/default-files.svg') }}"
                            alt="Card image cap" style="height: 20rem" />
                    @endif
                    <div class="card-body">
                        <p class="card-title">
                            Username : <span class="text-success font-bold">
                                {{ $worker->username }}
                            </span>
                        </p>
                        <p class="card-text">
                            Alamat : <span class="text-primary font-bold">
                                {{ $worker->w_ket_alamat }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h3 class="card-title">{{ $worker->fullname }}</h3>
                        <p class="card-text">
                            {{ $worker->provinsi->name_province }}, 
                            {{ $worker->kota->nama_kab_kota }}.
                            <span class="text-danger">
                                @if ($worker->tgl_lahir != null)
                                    {{ date("j F, Y", strtotime($worker->tgl_lahir)) }}
                                @else
                                    -
                                @endif
                            </span>
                        </p>
                        <p class="card-text">
                            {!! $worker->bio_worker !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection