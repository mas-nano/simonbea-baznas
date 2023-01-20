@extends('layouts.app')

@section('title', 'Data Awardee')

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
                <h1>Data Awardee</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                    <div class="breadcrumb-item">Awardee</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Awardee</h4>
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
                                                <th>Email</th>
                                                <th>Alamat</th>
                                                <th>NIM</th>
                                                <th>No Telp</th>
                                                <th>Semester</th>
                                                <th>Angkatan</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($awardee as $a)
                                                <tr>
                                                    <td>{{ $a->uuid }}</td>
                                                    <td>{{ $a->name }}</td>
                                                    <td>{{ $a->email }}</td>
                                                    <td>{{ $a->awardee == null ? 'Belum diisi' : $a->awardee->address }}
                                                    </td>
                                                    <td>{{ $a->awardee == null ? 'Belum diisi' : $a->awardee->nim }}</td>
                                                    <td>{{ $a->awardee == null ? 'Belum diisi' : $a->awardee->phone }}</td>
                                                    <td>{{ $a->awardee == null ? 'Belum diisi' : $a->awardee->level }}</td>
                                                    <td>{{ $a->awardee == null ? 'Belum diisi' : $a->awardee->gen }}
                                                    </td>
                                                    <td>
                                                        @if ($a->awardee == null)
                                                            <span class="badge badge-warning">Belum diisi</span>
                                                        @else
                                                            @if ($a->awardee->status == 'aktif')
                                                                <span class="badge badge-success">Aktif</span>
                                                            @elseif($a->awardee->status == 'pending')
                                                                <span class="badge badge-warning">Pending</span>
                                                            @else
                                                                <span class="badge badge-danger">Nonaktif</span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary"
                                                            href="{{ route('awardee.show', $a->uuid) }}">Lihat</a>
                                                        <a class="btn btn-warning"
                                                            href="{{ route('awardee.edit', $a->uuid) }}">Ubah</a>
                                                        <form method="POST"
                                                            action="{{ route('awardee.delete', $a->uuid) }}"
                                                            class="form d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit">Hapus</button>
                                                        </form>
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

    <script>
        $(".form").submit(function(event) {
            event.preventDefault()
            swal({
                    title: 'Apakah Anda yakin?',
                    text: 'Semua data user yang berhubungan akan dihapus.',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.submit()
                        swal('User sudah dihapus', {
                            icon: 'success',
                        });
                    }
                });
        })
    </script>
@endpush
