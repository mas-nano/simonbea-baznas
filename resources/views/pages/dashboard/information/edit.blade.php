@extends('layouts.app')

@section('title', 'Tambah Informasi Beasiswa')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Informasi Beasiswa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('information.index') }}">Informasi Beasiswa</a></div>
                    <div class="breadcrumb-item">Tambah Informasi Beasiswa</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah Informasi Beasiswa</h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text"
                                                class="form-control @if ($errors->has('title')) is-invalid @endif"
                                                name="title" value="{{ $information->title }}">
                                            @if ($errors->has('title'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('title') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select
                                                class="form-control selectric @if ($errors->has('category')) is-invalid @endif"
                                                name="category">
                                                <option value="Informasi" @if ($information->category == 'Infromasi') selected @endif>
                                                    Informasi</option>
                                                <option value="Berita" @if ($information->category == 'Berita') selected @endif>
                                                    Berita</option>
                                            </select>
                                            @if ($errors->has('category'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('category') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Paragraf
                                            Pertama</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text"
                                                class="form-control @if ($errors->has('first_paragraph')) is-invalid @endif"
                                                name="first_paragraph" value="{{ $information->first_paragraph }}">
                                            @if ($errors->has('first_paragraph'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('first_paragraph') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="summernote" name="body">{{ $information->body }}</textarea>
                                            @if ($errors->has('body'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('body') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                                        <div class="col-sm-12 col-md-7">
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" id="image-upload" name="thumbnail" />
                                            </div>
                                            @if ($errors->has('thumbnail'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('thumbnail') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </div>
                                    </div>
                                </form>
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
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

    <!-- Page Specific JS File -->
    <script>
        $("select").selectric();
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null, // Default: null
        });
    </script>
@endpush