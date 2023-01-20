@extends('layouts.app')

@section('title', 'Ubah Berkas')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ubah Berkas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('document.index') }}">Berkas</a></div>
                    <div class="breadcrumb-item">Ubah Berkas</div>
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
                                    <h4>Ubah Berkas</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>IPK</label>
                                        <div class="custom-file @if ($errors->has('ipk')) is-invalid @endif">
                                            <input type="file" class="custom-file-input" id="ipk" name="ipk">
                                            <label class="custom-file-label" for="ipk"
                                                id="ipkLabel">{{ explode('/', $document->ipk)[1] }}</label>
                                        </div>
                                        @if ($errors->has('ipk'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('ipk') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Organisasi (Opsional)</label>
                                        <div class="custom-file @if ($errors->has('organization')) is-invalid @endif">
                                            <input type="file" class="custom-file-input" id="org"
                                                name="organization">
                                            <label class="custom-file-label" for="org"
                                                id="orgLabel">{{ explode('/', $document->organization)[1] }}</label>
                                        </div>
                                        @if ($errors->has('organization'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('organization') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Prestasi (Opsional)</label>
                                        <div class="custom-file @if ($errors->has('achievement')) is-invalid @endif">
                                            <input type="file" class="custom-file-input" id="ach"
                                                name="achievement">
                                            <label class="custom-file-label" for="ach"
                                                id="achLabel">{{ explode('/', $document->achievement)[1] }}</label>
                                        </div>
                                        @if ($errors->has('achievement'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('achievement') }}
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
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
    <script>
        $('#ipk').change(function() {
            const file = this.files[0]
            if (file) {
                $("#ipkLabel").text(file.name)
            }
        })
        $('#org').change(function() {
            const file = this.files[0]
            if (file) {
                $("#orgLabel").text(file.name)
            }
        })
        $('#ach').change(function() {
            const file = this.files[0]
            if (file) {
                $("#achLabel").text(file.name)
            }
        })
    </script>
@endpush
