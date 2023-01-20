@extends('layouts.app')

@section('title', $operator->name)

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $operator->name }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('operator.index') }}">Operator</a></div>
                    <div class="breadcrumb-item">{{ $operator->name }}</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-5 col-lg-5">
                        <div class="card">
                            <img src="{{ $operator->operator == null ? asset('img/avatar/avatar-1.png') : asset('storage/' . $operator->operator->picture) }}"
                                alt="">
                        </div>
                    </div>
                    <div class="col-12 col-md-7 col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $operator->name }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <p>{{ $operator->name }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <p>{{ $operator->email }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <p>{{ $operator->operator == null ? 'Belum diisi' : $operator->operator->address }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Ubah Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
