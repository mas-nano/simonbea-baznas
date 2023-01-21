@extends('layouts.app')

@section('title', 'Create New Post')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Informasi Beasiswa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('information.index') }}">Informasi Beasiswa</a></div>
                    <div class="breadcrumb-item">{{ $information->title }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">{{ $information->title }}</h3>
                            </div>
                            <div class="card-body">
                                {!! $information->body !!}
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
    <script>
        $(document).ready(function() {
            $("img").addClass("img-responsive");
            $("img").css("max-width", "100%");
        });
    </script>
    <!-- Page Specific JS File -->
@endpush
