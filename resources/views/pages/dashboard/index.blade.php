@extends('layouts.app')

@section('title', 'Dashboard')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Peserta</h4>
                            </div>
                            <div class="card-body">
                                {{ $peserta }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Penerima</h4>
                            </div>
                            <div class="card-body">
                                {{ $awardee }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fa-solid fa-money-bill fas"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Sudah Transfer</h4>
                            </div>
                            <div class="card-body">
                                {{ $transfer }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fa-solid fa-money-bill fas"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Belum Transfer</h4>
                            </div>
                            <div class="card-body">
                                {{ $notTransfer }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #005331">Berita Terkini</h4>
                        </div>
                        <div class="card-body">
                            @foreach ($post as $i)
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <img src="{{ asset('storage/' . $i->thumbnail) }}" alt="" class="w-100">
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <a href="{{ route('information.show', $i->slug) }}">
                                            <h5 style="color: #005331">{{ $i->title }}</h5>
                                        </a>
                                        <p>{{ $i->excerpt() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
