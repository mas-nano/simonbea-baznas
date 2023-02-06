@extends('layouts.app')

@section('title', 'Form Transfer')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Form Transfer</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('pencairan.index') }}">Pencairan Dana</a></div>
                    <div class="breadcrumb-item">Form Transfer</div>
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
                                    <h4 style="color: #005331">Form Transfer</h4>
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
                                        <p>{{ $transfer->user->awardee->nim }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Bank</label>
                                        <p>{{ $transfer->user->awardee->bank }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Rekening</label>
                                        <p>{{ $transfer->user->awardee->account_number }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select
                                            class="form-control selectric @if ($errors->has('status')) is-invalid @endif"
                                            name="status">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="belum transfer">Belum Transfer</option>
                                            <option value="sudah transfer"
                                                {{ $transfer->status == 'sudah transfer' ? 'selected' : '' }}>Sudah Transfer
                                            </option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('status') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Dana BCB</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('dana')) is-invalid @endif"
                                            value="{{ $transfer->dana == null ? '' : $transfer->dana }}" name="dana">
                                        @if ($errors->has('dana'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('dana') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>SPP</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('spp')) is-invalid @endif"
                                            value="{{ $transfer->spp == null ? '' : $transfer->spp }}" name="spp">
                                        @if ($errors->has('spp'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('spp') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Dana Diterima</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('received_funds')) is-invalid @endif"
                                            value="{{ $transfer->received_funds == null ? '' : $transfer->received_funds }}"
                                            name="received_funds">
                                        @if ($errors->has('received_funds'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('received_funds') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('catatan')) is-invalid @endif"
                                            value="{{ $transfer->catatan == null ? '' : $transfer->catatan }}"
                                            name="catatan">
                                        @if ($errors->has('catatan'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('catatan') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Bukti Transfer</label>
                                        <div class="custom-file @if ($errors->has('invoice')) is-invalid @endif">
                                            <input type="file" class="custom-file-input" id="customFile" name="invoice">
                                            <label class="custom-file-label" for="customFile" id="customFileLabel">Choose
                                                file</label>
                                        </div>
                                        @if ($errors->has('invoice'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('invoice') }}
                                            </div>
                                        @endif
                                    </div>
                                    <img src="{{ $transfer->invoice == null ? '' : asset('storage/' . $transfer->invoice) }}"
                                        alt="" id="thumbnail" class="w-100">
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Transfer</button>
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
