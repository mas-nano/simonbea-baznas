@extends('layouts.app')

@section('title', 'Data Mutasi Penerima')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet"
        href="assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet"
        href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css"> --}}

    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Mutasi Penerima</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                    <div class="breadcrumb-item">Mutasi Penerima</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header justify-content-between">
                                <h4>Data Mutasi Penerima</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    @if (auth()->user()->role == 'operator')
                                                        UUID
                                                    @else
                                                        No
                                                    @endif
                                                </th>
                                                <th>Dari</th>
                                                <th>Ke</th>
                                                <th>Keterangan</th>
                                                @if (auth()->user()->role == 'operator')
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mutation as $key => $a)
                                                <tr>
                                                    @if (auth()->user()->role == 'operator')
                                                        <td>{{ $a->uuid }}</td>
                                                    @else
                                                        <td class="text-center">{{ ++$key }}</td>
                                                    @endif
                                                    <td>{{ $a->user->name }}</td>
                                                    <td>{{ $a->toName }}</td>
                                                    <td>{{ $a->keterangan }}</td>
                                                    @if (auth()->user()->role == 'operator')
                                                        <td>
                                                            <a href="{{ route('mutation.edit', $a->uuid) }}"
                                                                class="btn btn-primary mr-2">Edit</a>
                                                        </td>
                                                    @endif
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
@endsection

@push('scripts')
    <!-- JS Libraies -->
    {{-- <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script> --}}
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset() }}"></script> --}}
    {{-- <script src="{{ asset() }}"></script> --}}
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

    <script></script>
@endpush
