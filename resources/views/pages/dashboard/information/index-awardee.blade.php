@extends('layouts.app')

@section('title', 'Informasi Beasiswa')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Informasi Beasiswa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                    <div class="breadcrumb-item">Informasi Beasiswa</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                @foreach ($post as $i)
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <img src="{{ asset('storage/' . $i->thumbnail) }}" alt=""
                                                class="w-100">
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <a href="{{ route('information.show', $i->slug) }}">
                                                <h5>{{ $i->title }}</h5>
                                            </a>
                                            <p>{{ $i->excerpt() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
