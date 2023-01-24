@extends('layouts.app')

@section('title', 'Ubah Data Mutasi')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ubah Data Mutasi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('mutation.index') }}">Mutasi Penerima</a></div>
                    <div class="breadcrumb-item">Ubah Data Mutasi</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <form method="POST" action="">
                                @method('PUT')
                                @csrf
                                <div class="card-header">
                                    <h4>Ubah Data Mutasi</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Mutasi Dari</label>
                                        <p>{{ $mutation->user->name }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Mutasi Ke</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('toName')) is-invalid @endif"
                                            value="{{ $mutation->toName }}" name="toName">
                                        @if ($errors->has('toName'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('toName') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" class="form-control" value="{{ $mutation->keterangan }}"
                                            name="keterangan">
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
