@extends('layouts.app')

@section('title', $awardee->name)

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $awardee->name }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('awardee.index') }}">Awardee</a></div>
                    <div class="breadcrumb-item">{{ $awardee->name }}</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-5 col-lg-5">
                        <div class="card">
                            <img src="{{ $awardee->awardee == null ? asset('img/avatar/avatar-1.png') : ($awardee->awardee->picture == null ? asset('img/avatar/avatar-1.png') : asset('storage/' . $awardee->awardee->picture)) }}"
                                alt="">
                        </div>
                    </div>
                    <div class="col-12 col-md-7 col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $awardee->name }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <p>{{ $awardee->name }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <p>{{ $awardee->email }}</p>
                                </div>
                                <div class="form-group">
                                    <label>NIM</label>
                                    <p>{{ $awardee->awardee == null ? 'Belum diisi' : $awardee->awardee->nim }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <p>{{ $awardee->awardee == null ? 'Belum diisi' : $awardee->awardee->address }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <p>{{ $awardee->awardee == null ? 'Belum diisi' : $awardee->awardee->phone }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <p>{{ $awardee->awardee == null ? 'Belum diisi' : $awardee->awardee->level }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Angkatan</label>
                                    <p>{{ $awardee->awardee == null ? 'Belum diisi' : $awardee->awardee->gen }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <p>{{ $awardee->awardee == null ? 'Belum diisi' : $awardee->awardee->status }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>No Rekening</label>
                                    <p>{{ $awardee->awardee == null ? 'Belum diisi' : $awardee->awardee->account_number }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Bank</label>
                                    <p>{{ $awardee->awardee == null ? 'Belum diisi' : $awardee->awardee->bank }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <p>Rumah Tampak Depan</p>
                                    @if ($awardee->awardee == null)
                                        <p>Belum diisi</p>
                                    @else
                                        @if ($awardee->awardee->front_home == null)
                                            <p>Belum diisi</p>
                                        @else
                                            <img src="{{ asset('storage/' . $awardee->awardee->front_home) }}"
                                                alt="" class="w-75">
                                        @endif
                                    @endif

                                </div>
                                <div class="form-group">
                                    <p>Rumah Tampak Samping</p>
                                    @if ($awardee->awardee == null)
                                        <p>Belum diisi</p>
                                    @else
                                        @if ($awardee->awardee->side_home == null)
                                            <p>Belum diisi</p>
                                        @else
                                            <img src="{{ asset('storage/' . $awardee->awardee->side_home) }}"
                                                alt="" class="w-75">
                                        @endif
                                    @endif
                                </div>
                                <div class="form-group">
                                    <p>Rumah Tampak Belakang</p>
                                    @if ($awardee->awardee == null)
                                        <p>Belum diisi</p>
                                    @else
                                        @if ($awardee->awardee->back_home == null)
                                            <p>Belum diisi</p>
                                        @else
                                            <img src="{{ asset('storage/' . $awardee->awardee->back_home) }}"
                                                alt="" class="w-75">
                                        @endif
                                    @endif
                                </div>
                                <div class="form-group">
                                    <p>Surat Keterangan Tidak Mampu</p>
                                    @if ($awardee->awardee == null)
                                        <p>Belum diisi</p>
                                    @else
                                        @if ($awardee->awardee->surat_ket_tidak_mampu == null)
                                            <p>Belum diisi</p>
                                        @else
                                            <a href="{{ asset('storage/' . $awardee->awardee->surat_ket_tidak_mampu) }}"
                                                class="btn btn-primary"><i class="fa-solid fa-file-pdf"></i> Buka File</a>
                                        @endif
                                    @endif
                                </div>
                                <div class="form-group">
                                    <p>Sertifikat</p>
                                    @if ($awardee->awardee == null)
                                        <p>Belum diisi</p>
                                    @else
                                        @if ($awardee->awardee->certificates == null)
                                            <p>Belum diisi</p>
                                        @else
                                            <a href="{{ asset('storage/' . $awardee->awardee->certificates) }}"
                                                class="btn btn-primary"><i class="fa-solid fa-file-pdf"></i> Buka File</a>
                                        @endif
                                    @endif
                                </div>
                                <div class="form-group">
                                    <p>Identitas Mahasiswa</p>
                                    @if ($awardee->awardee == null)
                                        <p>Belum diisi</p>
                                    @else
                                        @if ($awardee->awardee->identity == null)
                                            <p>Belum diisi</p>
                                        @else
                                            <a href="{{ asset('storage/' . $awardee->awardee->identity) }}"
                                                class="btn btn-primary"><i class="fa-solid fa-file-pdf"></i> Buka File</a>
                                        @endif
                                    @endif
                                </div>
                                <div class="form-group">
                                    <p>Data Mahasiswa</p>
                                    @if ($awardee->awardee == null)
                                        <p>Belum diisi</p>
                                    @else
                                        @if ($awardee->awardee->cv == null)
                                            <p>Belum diisi</p>
                                        @else
                                            <a href="{{ asset('storage/' . $awardee->awardee->cv) }}"
                                                class="btn btn-primary"><i class="fa-solid fa-file-pdf"></i> Buka File</a>
                                        @endif
                                    @endif
                                </div>
                                <div class="form-group">
                                    <p>Bukti Pendaftaran</p>
                                    @if ($awardee->awardee == null)
                                        <p>Belum diisi</p>
                                    @else
                                        @if ($awardee->awardee->register_proof == null)
                                            <p>Belum diisi</p>
                                        @else
                                            <img src="{{ asset('storage/' . $awardee->awardee->register_proof) }}"
                                                alt="" class="w-75">
                                        @endif
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Nama Orang Tua</label>
                                    <p>{{ $awardee->awardee == null ? 'Belum diisi' : $awardee->awardee->parent->name }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Gaji Orang Tua</label>
                                    <p>{{ $awardee->awardee == null ? 'Belum diisi' : $awardee->awardee->parent->salary }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>No Telepon Orang Tua</label>
                                    <p>{{ $awardee->awardee == null ? 'Belum diisi' : $awardee->awardee->parent->phone }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Nama Operator</label>
                                    <p>{{ $awardee->awardee == null ? 'Belum diisi' : $awardee->awardee->operator->name }}
                                    </p>
                                </div>
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
