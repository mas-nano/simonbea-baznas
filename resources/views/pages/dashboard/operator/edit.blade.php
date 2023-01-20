@extends('layouts.app')

@section('title', 'Ubah Operator')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ubah Operator</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('operator.index') }}">Operator</a></div>
                    <div class="breadcrumb-item">Ubah Data Operator</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <form method="POST" action="" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="card-header">
                                    <h4>Ubah Operator</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('name')) is-invalid @endif"
                                            value="{{ $operator->name }}" name="name">
                                        @if ($errors->has('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <p>{{ $operator->email }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password"
                                            class="form-control  @if ($errors->has('password')) is-invalid @endif"
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
                                            class="form-control  @if ($errors->has('password_confirmation')) is-invalid @endif"
                                            name="password_confirmation">
                                        @if ($errors->has('password_confirmation'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password_confirmation') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Alamat</label>
                                        <textarea class="form-control @if ($errors->has('address')) is-invalid @endif" data-height="150" required=""
                                            name="address">{{ $operator->operator == null ? '' : $operator->operator->address }}</textarea>
                                        @if ($errors->has('address'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('address') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <div class="custom-file @if ($errors->has('picture')) is-invalid @endif">
                                            <input type="file" class="custom-file-input" id="customFile" name="picture">
                                            <label class="custom-file-label" for="customFile" id="customFileLabel">Choose
                                                file</label>
                                        </div>
                                        @if ($errors->has('picture'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('picture') }}
                                            </div>
                                        @endif
                                    </div>
                                    <img src="{{ $operator->operator == null ? '' : asset('storage/' . $operator->operator->picture) }}"
                                        alt="" id="thumbnail" class="w-100">
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

    <!-- Page Specific JS File -->
    <script>
        $('#customFile').change(function() {
            const file = this.files[0]
            if (file) {
                let reader = new FileReader()
                reader.onload = function(event) {
                    $('#customFileLabel').text(file.name)
                    $('#thumbnail').attr('src', event.target.result)
                }
                reader.readAsDataURL(file)
            }
        })
    </script>
@endpush
