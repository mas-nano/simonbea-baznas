@extends('layouts.app')

@section('title', 'Data Pencairan BCB Baznas')

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
                <h1>Data Pencairan Dana BCB</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                    <div class="breadcrumb-item">Pencairan Dana BCB</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header justify-content-between">
                                <h4>Data Pencairan Dana BCB</h4>
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
                                                <th>NIM</th>
                                                <th>Bank</th>
                                                <th>Rekening</th>
                                                <th>Status</th>
                                                @if (auth()->user()->role == 'operator')
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user as $a)
                                                <tr>
                                                    <td>{{ $a->uuid }}</td>
                                                    <td>{{ $a->user->name }}</td>
                                                    <td>{{ $a->user->email }}</td>
                                                    <td>{{ $a->user->awardee->nim }}</td>
                                                    <td>{{ $a->user->awardee->bank }}</td>
                                                    <td>{{ $a->user->awardee->account_number }}</td>
                                                    <td>
                                                        @if ($a->status == 'validasi')
                                                            Belum Transfer
                                                        @elseif($a->status == 'transfer')
                                                            Sudah Transfer
                                                        @endif
                                                    </td>
                                                    @if (auth()->user()->role == 'operator')
                                                        <td>
                                                            @if ($a->status == 'validasi')
                                                                <button id="modal-5"
                                                                    data-form="{{ route('pencairan.create', $a->uuid) }}"
                                                                    class="btn btn-primary btn-form"
                                                                    href="">Transfer</button>
                                                            @else
                                                                <button id="modal-1"
                                                                    data-url="{{ $a->invoice == null ? '' : asset('storage/' . $a->invoice) }}"
                                                                    class="btn btn-primary btn-bukti" href="">Lihat
                                                                    Bukti Transfer</button>
                                                            @endif
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

    <form class="modal-part" id="modal-login-part" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Bukti Transfer</label>
            <div class="custom-file @if ($errors->has('invoice')) is-invalid @endif">
                <input type="file" class="custom-file-input" id="invoice" name="invoice">
                <label class="custom-file-label" for="invoice" id="invoiceLabel">Choose
                    file</label>
            </div>
            @if ($errors->has('invoice'))
                <div class="invalid-feedback">
                    {{ $errors->first('invoice') }}
                </div>
            @endif
        </div>
        <img src="" alt="" id="invoiceThumbnail" class="w-100">
    </form>

    <div class="modal-part" id="bukti-transfer">
        <img src="" alt="" id="buktiTransferImg" class="w-100">
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

    <script></script>
    <script>
        $(document).ready(function() {
            $('#invoice').change(function() {
                const file = this.files[0]
                console.log(file);
                if (file) {
                    let reader = new FileReader()
                    reader.onload = function(event) {
                        $('#invoiceLabel').text(file.name)
                        $('#invoiceThumbnail').attr('src', event.target.result)
                    }
                    reader.readAsDataURL(file)
                }
            })
            $(".btn-bukti").click(function(e) {
                $("#buktiTransferImg").attr("src", $(this).data('url'))
            })
        })
    </script>

    <script>
        $(".btn-form").click(function(e) {
            $("form").attr('action', $(this).data('form'))
        })
        $("#modal-5").fireModal({
            title: 'Upload Bukti Transfer',
            body: $("#modal-login-part"),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                e.preventDefault();
                swal({
                        title: 'Apakah Anda yakin?',
                        text: 'Anda tidak bisa mengubah data bukti transfer setelah simpan.',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            e.target.submit()
                            swal('Bukti transfer sudah dihapus', {
                                icon: 'success',
                            });
                        } else {
                            form.stopProgress();
                        }
                    });
            },
            buttons: [{
                text: 'Simpan',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function(modal) {}
            }]
        });
        $("#modal-1").fireModal({
            title: 'Bukti Transfer',
            body: $("#bukti-transfer"),
        });
    </script>
@endpush
