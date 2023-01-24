@extends('layouts.app')

@section('title', 'Pengaturan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pengaturan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Pengaturan</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <form method="POST" action="{{ route('profile.save.setting') }}">
                                @method('PUT')
                                @csrf
                                <div class="card-header">
                                    <h4>Ubah Password</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Password Lama</label>
                                        <input type="password"
                                            class="form-control @if ($errors->has('password_old')) is-invalid @endif"
                                            name="password_old">
                                        @if ($errors->has('password_old'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password_old') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Password Baru</label>
                                        <input type="password"
                                            class="form-control @if ($errors->has('password')) is-invalid @endif"
                                            name="password">
                                        @if ($errors->has('password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password"
                                            class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif"
                                            name="password_confirmation">
                                        @if ($errors->has('password_confirmation'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password_confirmation') }}
                                            </div>
                                        @endif
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
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    @if (session('error'))
        <script>
            swal({
                icon: 'warning',
                title: 'Oops...',
                text: '{{ session('error') }}',
            })
        </script>
    @endif
    @if (session('success'))
        <script>
            swal({
                icon: 'success',
                text: '{{ session('success') }}',
            })
        </script>
    @endif
@endpush
