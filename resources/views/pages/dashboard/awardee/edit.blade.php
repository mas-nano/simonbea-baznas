@extends('layouts.app')

@section('title', 'Ubah Penerima')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ubah Penerima</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('awardee.index') }}">Awardee</a></div>
                    <div class="breadcrumb-item">Ubah Data Penerima</div>
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
                                    <h4>Ubah Penerima</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('name')) is-invalid @endif"
                                            value="{{ $awardee->name }}" name="name">
                                        @if ($errors->has('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <p>{{ $awardee->email }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>NIM</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('nim')) is-invalid @endif"
                                            value="{{ $awardee->awardee == null ? '' : $awardee->awardee->nim }}"
                                            name="nim">
                                        @if ($errors->has('nim'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('nim') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea class="form-control @if ($errors->has('address')) is-invalid @endif" data-height="150" required=""
                                            name="address">{{ $awardee->awardee == null ? '' : $awardee->awardee->address }}</textarea>
                                        @if ($errors->has('address'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('address') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>No Telepon</label>
                                        <div class="form-group">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">+62</div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @if ($errors->has('phone')) is-invalid @endif"
                                                    value="{{ $awardee->awardee == null ? '' : $awardee->awardee->phone }}"
                                                    name="phone">
                                                @if ($errors->has('phone'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('phone') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Semester</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('level')) is-invalid @endif"
                                            value="{{ $awardee->awardee == null ? '' : $awardee->awardee->level }}"
                                            name="level">
                                        @if ($errors->has('level'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('level') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Angkatan</label>
                                        <select
                                            class="form-control selectric @if ($errors->has('gen')) is-invalid @endif"
                                            name="gen">
                                            <option value="">
                                                Pilih Tahun Angkatan</option>
                                            @for ($i = date('Y'); $i >= date('Y') - 10; $i--)
                                                <option value="{{ $i }}"
                                                    {{ $awardee->awardee == null ? '' : ($awardee->awardee->gen == $i ? 'selected' : '') }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                        @if ($errors->has('gen'))
                                            <div class="text-caption"
                                                style="width: 100%; margin-top: .25rem; font-size: 80%; color: #dc3545;">
                                                {{ $errors->first('gen') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select
                                            class="form-control selectric @if ($errors->has('status')) is-invalid @endif"
                                            name="status">
                                            <option value="aktif"
                                                {{ $awardee->awardee == null ? '' : ($awardee->awardee->status == 'aktif' ? 'selected' : '') }}>
                                                Aktif</option>
                                            <option value="pending"
                                                {{ $awardee->awardee == null ? 'selected' : ($awardee->awardee->status == 'pending' ? 'selected' : '') }}>
                                                Pending</option>
                                            <option value="nonaktif"
                                                {{ $awardee->awardee == null ? '' : ($awardee->awardee->status == 'nonaktif' ? 'selected' : '') }}>
                                                Nonaktif</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <div class="text-caption"
                                                style="width: 100%; margin-top: .25rem; font-size: 80%; color: #dc3545;">
                                                {{ $errors->first('status') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>No Rekening</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('account_number')) is-invalid @endif"
                                            value="{{ $awardee->awardee == null ? '' : $awardee->awardee->account_number }}"
                                            name="account_number">
                                        @if ($errors->has('account_number'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('account_number') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Bank</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('bank')) is-invalid @endif"
                                            value="{{ $awardee->awardee == null ? '' : $awardee->awardee->bank }}"
                                            name="bank">
                                        @if ($errors->has('bank'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('bank') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Orang Tua</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('parent_name')) is-invalid @endif"
                                            value="{{ $awardee->awardee == null ? '' : $awardee->awardee->parent->name }}"
                                            name="parent_name">
                                        @if ($errors->has('parent_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('parent_name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Penghasilan Orang Tua</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('parent_salary')) is-invalid @endif"
                                            value="{{ $awardee->awardee == null ? '' : $awardee->awardee->parent->salary }}"
                                            name="parent_salary">
                                        @if ($errors->has('parent_salary'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('parent_salary') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>No Telepon Orang Tua</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">+62</div>
                                            </div>
                                            <input type="text"
                                                class="form-control  @if ($errors->has('parent_phone')) is-invalid @endif"
                                                value="{{ $awardee->awardee == null ? '' : $awardee->awardee->parent->phone }}"
                                                name="parent_phone">
                                            @if ($errors->has('parent_phone'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('parent_phone') }}
                                                </div>
                                            @endif
                                        </div>
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

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <!-- Page Specific JS File -->
@endpush
