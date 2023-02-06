@extends('layouts.home')

@section('title', 'Landing')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <nav class="navbar navbar-expand-lg" style="background: #002617; position:relative; left:0; right:0; height:100px">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#"><img src="{{ asset('img/logo.png') }}"
                    alt="logo" width="50">
                <span class="ml-2">SIMONBEA BAZNAS</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#visi">Visi Misi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('register') }}">Daftar</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-3" id="home">
        <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators3" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators3" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators3" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('img/pic1.jpg') }}" alt="First slide"
                        style="object-fit: cover; object-position:center; height:500px">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('img/1608542275.jpeg') }}" alt="Second slide"
                        style="object-fit: cover; object-position:center; height:500px">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('img/1608542742.jpeg') }}" alt="Third slide"
                        style="object-fit: cover; object-position:center; height:500px">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="mt-3" id="visi">
            <h3 style="color: #002617">Apa Itu Lembaga Beasiswa BAZNAS</h3>
            <p style="color: #002617">LBB adalah program dari Divisi Pendistribusian dan Pendayagunaan yang bertugas
                menyediakan dana pendidikan
                demi
                terjaminnya keberlangsungan program pendidikan bagi golongan mahasiswa kurang mampu/ miskin sebagai
                pertanggungjawaban antar generasi. Dalam tugasnya LBB menyelenggarakan fungsi Perencanaan, Pelaksanaan,
                Pengendalian, dan Pelaporan.</p>
        </div>
        <div class="mt-5">
            <h3 style="color: #002617">Tujuan Lembaga Beasiswa BAZNAS</h3>
            <p style="color: #002617">Lembaga Beasiswa BAZNAS (LBB) didirikan dengan dua tujuan utama</p>
            <ol>
                <li>Menyediakan dana pendidikan demi terjaminnya keberlangsungan program pendidikan bagi golongan kurang
                    mampu/ miskin sebagai pertanggungjawaban antar generasi</li>
                <li>Menyiapkan generasi penerus bangsa yang memiliki kedalaman ilmu pengetahuan dan keluhuran akhlak.</li>
            </ol>
        </div>
        <div class="mt-5" id="kontak">
            <h3 style="color: #002617">Kontak Kami</h3>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #002617">Tentang Kami</h4>
                        </div>
                        <div class="card-body">
                            Lembaga Beasiswa BAZNAS bervisi menyiapkan generasi penerus bangsa yang memiliki kedalaman ilmu
                            pengetahuan dan keluhuran akhlak.
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #002617">Alamat</h4>
                        </div>
                        <div class="card-body">
                            Town House Cimanggu Resindence Blok B 8, Jalan Perdana Raya, Budi Agung, RT.15/RW.04,
                            Kedungbadak, Tanah Sereal, Bogor, Jawa Barat 16164
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #002617">Info Kontak</h4>
                        </div>
                        <div class="card-body">
                            <p>lbb@beasiswa.baznas.go.id</p>
                            <p> 0813-8286-7500 - Sholeh /</p>
                            <p>
                                0812-1273-1549 - Intan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
