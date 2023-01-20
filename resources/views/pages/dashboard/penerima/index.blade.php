@extends('layouts.app')

@section('title', 'Penerima BCB Baznas')

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
                <h1>Penerima BCB Baznas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                    <div class="breadcrumb-item">Penerima BCB Baznas</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header justify-content-between">
                                <h4>Penerima BCB Baznas</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    No
                                                </th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>NIM</th>
                                                <th>Semester</th>
                                                <th>Angkatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($awardee as $key => $a)
                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td>{{ $a->user->name }}
                                                    <td>
                                                        {{ $a->user->email }}
                                                    </td>
                                                    <td>
                                                        {{ $a->user->awardee == null ? '-' : $a->user->awardee->nim }}
                                                    </td>
                                                    <td>{{ $a->user->awardee == null ? '-' : $a->user->awardee->level }}
                                                    </td>
                                                    <td>
                                                        {{ $a->user->awardee == null ? '-' : $a->user->awardee->gen }}
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
@endsection

@push('scripts')
    <!-- JS Libraies -->
    {{-- <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script> --}}
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset() }}"></script> --}}
    {{-- <script src="{{ asset() }}"></script> --}}
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

    @if (session('pending'))
        <script>
            swal({
                icon: 'info',
                title: 'Oops...',
                text: '{{ session('pending') }}',
            })
        </script>
    @endif
    <script>
        $(".form").submit(function(event) {
            event.preventDefault()
            swal({
                    title: 'Apakah Anda yakin?',
                    text: 'Sekali menghapus dokumen, tidak bisa dikembalikan lagi.',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.submit()
                        swal('Dokumen sudah dihapus', {
                            icon: 'success',
                        });
                    }
                });
        })
    </script>
@endpush
