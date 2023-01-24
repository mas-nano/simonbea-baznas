@extends('layouts.app')

@section('title', 'Berkas')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet"
        href="assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet"
        href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css"> --}}

    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Berkas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                    <div class="breadcrumb-item">Berkas</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header flex-column">
                                <div class="d-flex justify-content-between w-100">
                                    <h4>Berkas</h4>
                                    <div class="d-flex">
                                        <form action="{{ route('document.reminder') }}" method="POST">
                                            @csrf
                                            <button class="btn btn-primary mr-2" type="submit"><i
                                                    class="fa-solid fa-bell"></i> Ingatkan Peserta</button>
                                        </form>
                                        <button class="btn btn-warning" href="{{ route('document.create') }}"
                                            id="modal-5"><i class="fa-solid fa-plus"></i> Ubah Periode</button>
                                    </div>
                                </div>
                                <p class="m-0 w-100">
                                    Periode: Semester {{ ucfirst($period->semester) }} {{ date('Y') }}. Tanggal Akhir
                                    Pendaftaran: {{ $period->last_registration }}
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    UUID
                                                </th>
                                                <th>Nama</th>
                                                <th>IPK</th>
                                                <th>Organisasi</th>
                                                <th>Prestasi</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($document as $d)
                                                <tr>
                                                    <td>{{ $d->uuid }}</td>
                                                    <td>{{ $d->user->name }}</td>
                                                    <td><a href="{{ asset('storage/' . $d->ipk) }}"
                                                            class="btn btn-primary"><i class="fa-solid fa-file-pdf"></i>
                                                            Buka File</a></td>
                                                    <td>
                                                        @if ($d->organization == null)
                                                            -
                                                        @else
                                                            <a href="{{ asset('storage/' . $d->organization) }}"
                                                                class="btn btn-primary"><i class="fa-solid fa-file-pdf"></i>
                                                                Buka File</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($d->achievement == null)
                                                            -
                                                        @else
                                                            <a href="{{ asset('storage/' . $d->achievement) }}"
                                                                class="btn btn-primary"><i class="fa-solid fa-file-pdf"></i>
                                                                Buka File</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($d->status == 'transfer')
                                                            Validasi
                                                        @else
                                                            {{ ucfirst($d->status) }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary"
                                                            href="{{ route('awardee.show', $d->user->uuid) }}">Detail
                                                            Penerima</a>
                                                        @if ($d->status != 'validasi' && $d->status != 'tolak')
                                                            <form method="POST"
                                                                action="{{ route('document.validation', $d->uuid) }}"
                                                                class="form d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <button class="btn btn-success" type="submit"
                                                                    name="valid" value="true">Validasi</button>
                                                            </form>
                                                            <form method="POST"
                                                                action="{{ route('document.validation', $d->uuid) }}"
                                                                class="form d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <button class="btn btn-danger" type="submit" name="decline"
                                                                    value="true">Tolak</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <form class="modal-part" id="modal-login-part" action="{{ route('period.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Semester</label>
            <select class="form-control selectric @if ($errors->has('semester')) is-invalid @endif" name="semester">
                <option value="" selected>Pilih Semester</option>
                <option value="ganjil" @if ($period->semester == 'ganjil') selected @endif>Ganjil</option>
                <option value="genap" @if ($period->semester == 'genap') selected @endif>Genap</option>
            </select>
            @if ($errors->has('semester'))
                <div class="invalid-feedback">
                    {{ $errors->first('semester') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label>Tanggal Akhir Pendaftaran</label>
            <input type="text" class="form-control datetimepicker" name="last_registration"
                @if ($period->last_registration != null) value="{{ $period->last_registration }}" @endif>
            @if ($errors->has('last_registration'))
                <div class="invalid-feedback">
                    {{ $errors->first('last_registration') }}
                </div>
            @endif
        </div>
    </form>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    {{-- <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script> --}}
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    {{-- <script src="{{ asset() }}"></script> --}}
    {{-- <script src="{{ asset() }}"></script> --}}
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    <script>
        $("#modal-5").fireModal({
            title: 'Periode Pendaftaran',
            body: $("#modal-login-part"),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            buttons: [{
                text: 'Simpan',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function(modal) {}
            }]
        });
    </script>
@endpush
