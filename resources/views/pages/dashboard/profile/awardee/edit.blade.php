@extends('layouts.app')

@section('title', 'Ubah Profil')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ubah Profil</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('profile.index') }}">Profil</a></div>
                    <div class="breadcrumb-item">Ubah Data Profil</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <form method="POST" action="{{ route('profile.awardee.update') }}"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="card-header">
                                    <h4>Ubah Profil</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('name')) is-invalid @endif"
                                            value="{{ $awardee->name }}" name="name">
                                        @if ($errors->has('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <p>{{ $awardee->email }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>NIM</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('nim')) is-invalid @endif"
                                            value="{{ $awardee->awardee == null ? '' : $awardee->awardee->nim }}"
                                            name="nim">
                                        @if ($errors->has('nim'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('nim') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea class="form-control @if ($errors->has('address')) is-invalid @endif" data-height="150" required=""
                                            name="address">{{ $awardee->awardee == null ? '' : $awardee->awardee->address }}</textarea>
                                        @if ($errors->has('address'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('address') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>No Telepon</label>
                                        <div class="form-group">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">+62</div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @if ($errors->has('phone')) is-invalid @endif"
                                                    value="{{ $awardee->awardee == null ? '' : $awardee->awardee->phone }}"
                                                    name="phone">
                                                @if ($errors->has('phone'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('phone') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Semester</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('level')) is-invalid @endif"
                                            value="{{ $awardee->awardee == null ? '' : $awardee->awardee->level }}"
                                            name="level">
                                        @if ($errors->has('level'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('level') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Angkatan</label>
                                        <select
                                            class="form-control selectric @if ($errors->has('gen')) is-invalid @endif"
                                            name="gen">
                                            <option value="">
                                                Pilih Tahun Angkatan</option>
                                            @for ($i = date('Y'); $i >= date('Y') - 10; $i--)
                                                <option value="{{ $i }}"
                                                    {{ $awardee->awardee == null ? '' : ($awardee->awardee->gen == $i ? 'selected' : '') }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                        @if ($errors->has('gen'))
                                            <div class="text-caption"
                                                style="width: 100%; margin-top: .25rem; font-size: 80%; color: #dc3545;">
                                                {{ $errors->first('gen') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>No Rekening</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('account_number')) is-invalid @endif"
                                            value="{{ $awardee->awardee == null ? '' : $awardee->awardee->account_number }}"
                                            name="account_number">
                                        @if ($errors->has('account_number'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('account_number') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Bank</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('bank')) is-invalid @endif"
                                            value="{{ $awardee->awardee == null ? '' : $awardee->awardee->bank }}"
                                            name="bank">
                                        @if ($errors->has('bank'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('bank') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Rumah Tampak Depan</label>
                                        <div class="custom-file @if ($errors->has('front_home')) is-invalid @endif">
                                            <input type="file" class="custom-file-input" id="frontHome"
                                                name="front_home">
                                            <label class="custom-file-label" for="frontHome" id="frontHomeLabel">Choose
                                                file</label>
                                        </div>
                                        @if ($errors->has('front_home'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('front_home') }}
                                            </div>
                                        @endif
                                    </div>
                                    <img src="{{ $awardee->awardee == null ? '' : asset('storage/' . $awardee->awardee->front_home) }}"
                                        alt="" id="frontHomeThumbnail" class="w-100">
                                    <div class="form-group">
                                        <label>Rumah Tampak Samping</label>
                                        <div class="custom-file @if ($errors->has('side_home')) is-invalid @endif">
                                            <input type="file" class="custom-file-input" id="sideHome" name="side_home">
                                            <label class="custom-file-label" for="sideHome" id="sideHomeLabel">Choose
                                                file</label>
                                        </div>
                                        @if ($errors->has('side_home'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('side_home') }}
                                            </div>
                                        @endif
                                    </div>
                                    <img src="{{ $awardee->awardee == null ? '' : asset('storage/' . $awardee->awardee->side_home) }}"
                                        alt="" id="sideHomeThumbnail" class="w-100">
                                    <div class="form-group">
                                        <label>Rumah Tampak Belakang</label>
                                        <div class="custom-file @if ($errors->has('back_home')) is-invalid @endif">
                                            <input type="file" class="custom-file-input" id="backHome"
                                                name="back_home">
                                            <label class="custom-file-label" for="backHome" id="backHomeLabel">Choose
                                                file</label>
                                        </div>
                                        @if ($errors->has('back_home'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('back_home') }}
                                            </div>
                                        @endif
                                    </div>
                                    <img src="{{ $awardee->awardee == null ? '' : asset('storage/' . $awardee->awardee->back_home) }}"
                                        alt="" id="backHomeThumbnail" class="w-100">
                                    <div class="form-group">
                                        <label>Surat Keterangan Tidak Mampu</label>
                                        <div class="custom-file @if ($errors->has('surat_ket_tidak_mampu')) is-invalid @endif">
                                            <input type="file" class="custom-file-input" id="sktm"
                                                name="surat_ket_tidak_mampu">
                                            <label class="custom-file-label" for="sktm" id="sktmLabel">Choose
                                                file</label>
                                        </div>
                                        @if ($errors->has('surat_ket_tidak_mampu'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('surat_ket_tidak_mampu') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Sertifikat</label>
                                        <div class="custom-file @if ($errors->has('certificates')) is-invalid @endif">
                                            <input type="file" class="custom-file-input" id="certificate"
                                                name="certificates">
                                            <label class="custom-file-label" for="certificate"
                                                id="certificateLabel">Choose
                                                file</label>
                                        </div>
                                        @if ($errors->has('certificates'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('certificates') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Identitas Mahasiswa</label>
                                        <div class="custom-file @if ($errors->has('identity')) is-invalid @endif">
                                            <input type="file" class="custom-file-input" id="identity"
                                                name="identity">
                                            <label class="custom-file-label" for="identity" id="identityLabel">Choose
                                                file</label>
                                        </div>
                                        @if ($errors->has('identity'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('identity') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Bukti Pendaftaran</label>
                                        <div class="custom-file @if ($errors->has('register_proof')) is-invalid @endif">
                                            <input type="file" class="custom-file-input" id="registerProof"
                                                name="register_proof">
                                            <label class="custom-file-label" for="registerProof"
                                                id="registerProofLabel">Choose
                                                file</label>
                                        </div>
                                        @if ($errors->has('register_proof'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('register_proof') }}
                                            </div>
                                        @endif
                                    </div>
                                    <img src="{{ $awardee->awardee == null ? '' : asset('storage/' . $awardee->awardee->register_proof) }}"
                                        alt="" id="registerProofThumbnail" class="w-100">
                                    <div class="form-group">
                                        <label>Data Mahasiswa</label>
                                        <div class="custom-file @if ($errors->has('cv')) is-invalid @endif">
                                            <input type="file" class="custom-file-input" id="cv"
                                                name="cv">
                                            <label class="custom-file-label" for="cv" id="cvLabel">Choose
                                                file</label>
                                        </div>
                                        @if ($errors->has('cv'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('cv') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Orang Tua</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('parent_name')) is-invalid @endif"
                                            value="{{ $awardee->awardee == null ? '' : $awardee->awardee->parent->name }}"
                                            name="parent_name">
                                        @if ($errors->has('parent_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('parent_name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Penghasilan Orang Tua</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('parent_salary')) is-invalid @endif"
                                            value="{{ $awardee->awardee == null ? '' : $awardee->awardee->parent->salary }}"
                                            name="parent_salary">
                                        @if ($errors->has('parent_salary'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('parent_salary') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>No Telepon Orang Tua</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">+62</div>
                                            </div>
                                            <input type="text"
                                                class="form-control  @if ($errors->has('parent_phone')) is-invalid @endif"
                                                value="{{ $awardee->awardee == null ? '' : $awardee->awardee->parent->phone }}"
                                                name="parent_phone">
                                            @if ($errors->has('parent_phone'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('parent_phone') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <div class="custom-file @if ($errors->has('picture')) is-invalid @endif">
                                            <input type="file" class="custom-file-input" id="photo"
                                                name="picture">
                                            <label class="custom-file-label" for="photo" id="photoLabel">Choose
                                                file</label>
                                        </div>
                                        @if ($errors->has('picture'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('picture') }}
                                            </div>
                                        @endif
                                    </div>
                                    <img src="{{ $awardee->awardee == null ? '' : asset('storage/' . $awardee->awardee->picture) }}"
                                        alt="" id="photoThumbnail" class="w-100">
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
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script>
        $('#frontHome').change(function() {
            const file = this.files[0]
            if (file) {
                let reader = new FileReader()
                reader.onload = function(event) {
                    $('#frontHomeLabel').text(file.name)
                    $('#frontHomeThumbnail').attr('src', event.target.result)
                }
                reader.readAsDataURL(file)
            }
        })
        $('#sideHome').change(function() {
            const file = this.files[0]
            if (file) {
                let reader = new FileReader()
                reader.onload = function(event) {
                    $('#sideHomeLabel').text(file.name)
                    $('#sideHomeThumbnail').attr('src', event.target.result)
                }
                reader.readAsDataURL(file)
            }
        })
        $('#backHome').change(function() {
            const file = this.files[0]
            if (file) {
                let reader = new FileReader()
                reader.onload = function(event) {
                    $('#backHomeLabel').text(file.name)
                    $('#backHomeThumbnail').attr('src', event.target.result)
                }
                reader.readAsDataURL(file)
            }
        })
        $('#photo').change(function() {
            const file = this.files[0]
            if (file) {
                let reader = new FileReader()
                reader.onload = function(event) {
                    $('#photoLabel').text(file.name)
                    $('#photoThumbnail').attr('src', event.target.result)
                }
                reader.readAsDataURL(file)
            }
        })
        $('#registerProof').change(function() {
            const file = this.files[0]
            if (file) {
                let reader = new FileReader()
                reader.onload = function(event) {
                    $('#registerProofLabel').text(file.name)
                    $('#registerProofThumbnail').attr('src', event.target.result)
                }
                reader.readAsDataURL(file)
            }
        })
        $('#sktm').change(function() {
            const file = this.files[0]
            if (file) {
                $("#sktmLabel").text(file.name)
            }
        })
        $('#certificate').change(function() {
            const file = this.files[0]
            if (file) {
                $("#certificateLabel").text(file.name)
            }
        })
        $('#identity').change(function() {
            const file = this.files[0]
            if (file) {
                $("#identityLabel").text(file.name)
            }
        })
        $('#cv').change(function() {
            const file = this.files[0]
            if (file) {
                $("#cvLabel").text(file.name)
            }
        })
    </script>
@endpush
