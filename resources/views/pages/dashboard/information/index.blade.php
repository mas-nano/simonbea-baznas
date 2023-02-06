@extends('layouts.app')

@section('title', 'Data Informasi Beasiswa')

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
                <h1>Informasi Beasiswa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                    <div class="breadcrumb-item">Informasi Beasiswa</div>
                </div>
            </div>

            <div class="section-body">
                <div class="d-flex justify-content-end mb-3">
                    <a class="btn btn-success" href="{{ route('information.create') }}"><i class="fa-solid fa-plus"></i>
                        Tambah Informasi</a>
                </div>
                <div class="row">
                    @foreach ($post as $p)
                        <div class="col-12 col-md-6 col-lg-4 pb-4">
                            <div class="card card-success h-100">
                                <div class="card-header">
                                    <img src="{{ asset('storage/' . $p->thumbnail) }}" alt="" class="w-100"
                                        style="aspect-ratio:16/9; object-fit:cover; object-position:center">
                                </div>
                                <div class="card-body">
                                    <h4>{{ $p->title }}</h4>
                                    <p>{{ $p->excerpt() }}</p>
                                </div>
                                <div class="card-footer d-flex">
                                    <a class="btn btn-primary mr-1"
                                        href="{{ route('information.show', $p->slug) }}">Lihat</a>
                                    <a class="btn btn-warning mr-1"
                                        href="{{ route('information.edit', $p->slug) }}">Ubah</a>
                                    <form method="POST" action="{{ route('information.delete', $p->slug) }}"
                                        class="form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
    <script>
        $(".form").submit(function(event) {
            event.preventDefault()
            swal({
                    title: 'Apakah Anda yakin?',
                    text: 'Sekali menghapus informasi, tidak bisa dikembalikan lagi.',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.submit()
                        swal('Informasi sudah dihapus', {
                            icon: 'success',
                        });
                    }
                });
        })
    </script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush
