@extends('layouts.app')

@section('title', 'Data Transfer')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Transfer</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('pencairan.index') }}">Pencairan Dana</a></div>
                    <div class="breadcrumb-item">Data Transfer</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Transfer</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <p>{{ $transfer->user->name }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <p>{{ $transfer->user->email }}</p>
                                </div>
                                <div class="form-group">
                                    <label>NIM</label>
                                    <p>{{ $transfer->user->awardee == null ? 'Belum diisi' : $transfer->user->awardee->nim }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Bank</label>
                                    <p>{{ $transfer->user->awardee == null ? 'Belum diisi' : $transfer->user->awardee->bank }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Rekening</label>
                                    <p>{{ $transfer->user->awardee == null ? 'Belum diisi' : $transfer->user->awardee->account_number }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <p>{{ $transfer->status }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Dana BCB</label>
                                    <p>{{ $transfer->dana == null ? 'Belum diisi' : $transfer->dana }}</p>
                                </div>
                                <div class="form-group">
                                    <label>SPP</label>
                                    <p>{{ $transfer->spp == null ? 'Belum diisi' : $transfer->spp }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Dana Diterima</label>
                                    <p>{{ $transfer->received_funds == null ? 'Belum diisi' : $transfer->received_funds }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <p>{{ $transfer->catatan == null ? 'Belum diisi' : $transfer->catatan }}</p>
                                </div>
                                <div class="form-group">
                                    <label class="d-block">Bukti Transfer</label>
                                    <img src="{{ $transfer->invoice == null ? '' : asset('storage/' . $transfer->invoice) }}"
                                        alt="" class="w-100">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
