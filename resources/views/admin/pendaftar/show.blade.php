@extends('layouts.app')
@section('title', 'Detail Biodata Pendaftar')

@section('content')
    <x-card>
        <x-slot name="header" class="bg-white d-flex justify-content-between">
            <h5 class="card-title mt-3 mb-3">Biodata Pendaftar</h5>
            <a class="btn btn-primary" href="{{route('admin.pendaftar.index')}}">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </x-slot>

        <div class="row">
            <div class="col-lg-12">
                <x-form-input-inline label="POSISI YANG DILAMAR"
                    value="{{ !empty($data->position) ? $data->position : old('position') }}" type="text" name="position"
                    id="position" class="position" list-option="" :label-required="true" :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="NAMA" value="{{ !empty($data->name) ? $data->name : old('name') }}"
                    type="text" name="name" id="name" class="name" list-option="" :label-required="true"
                    :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="NO. KTP" value="{{ !empty($data->no_ktp) ? $data->no_ktp : old('no_ktp') }}"
                    type="number" name="no_ktp" id="no_ktp" class="no_ktp" list-option="" :label-required="true"
                    :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="TEMPAT LAHIR"
                    value="{{ !empty($data->tempat_lahir) ? $data->tempat_lahir : old('tempat_lahir') }}" type="text"
                    name="tempat_lahir" id="tempat_lahir" class="tempat_lahir" list-option="" :label-required="true"
                    :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="TANGGAL LAHIR"
                    value="{{ !empty($data->tanggal_lahir) ? $data->tanggal_lahir : old('tanggal_lahir') }}" type="date"
                    name="tanggal_lahir" id="tanggal_lahir" class="tanggal_lahir" list-option="" :label-required="true"
                    :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="JENIS KELAMIN"
                    value="{{ !empty($data->jenis_kelamin) ? $data->jenis_kelamin : old('jenis_kelamin') }}" type="radio"
                    name="jenis_kelamin" id="jenis_kelamin" class="jenis_kelamin" :list-option="['LAKI-LAKI' => 'LAKI-LAKI', 'PEREMPUAN' => 'PEREMPUAN']" :label-required="true"
                    :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="AGAMA" value="{{ !empty($data->agama) ? $data->agama : old('agama') }}"
                    type="text" name="agama" id="agama" class="agama" list-option="" :label-required="true"
                    :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="GOLONGAN DARAH"
                    value="{{ !empty($data->gol_darah) ? $data->gol_darah : old('gol_darah') }}" type="text"
                    name="gol_darah" id="gol_darah" class="gol_darah" list-option="" :label-required="true"
                    :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="STATUS" value="{{ !empty($data->status) ? $data->status : old('status') }}"
                    type="text" name="status" id="status" class="status" list-option="" :label-required="true"
                    :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="ALAMAT KTP"
                    value="{{ !empty($data->alamat_ktp) ? $data->alamat_ktp : old('alamat_ktp') }}" type="textarea"
                    name="alamat_ktp" id="alamat_ktp" class="alamat_ktp" list-option="" :label-required="true"
                    :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="ALAMAT TINGGAL"
                    value="{{ !empty($data->alamat_tinggal) ? $data->alamat_tinggal : old('alamat_tinggal') }}"
                    type="textarea" name="alamat_tinggal" id="alamat_tinggal" class="alamat_tinggal" list-option=""
                    :label-required="true" :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="EMAIL" value="{{ !empty($data->email) ? $data->email : old('email') }}"
                    type="email" name="email" id="email" class="email" list-option="" :label-required="true"
                    :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="NO. TELP"
                    value="{{ !empty($data->no_telepon) ? $data->no_telepon : old('no_telepon') }}" type="text"
                    name="no_telepon" id="no_telepon" class="no_telepon" list-option="" :label-required="true"
                    :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="ORANG TERDEKAT YANG DAPAT DIHUBUNGI"
                    value="{{ !empty($data->orang_terdekat) ? $data->orang_terdekat : old('orang_terdekat') }}"
                    type="text" name="orang_terdekat" id="orang_terdekat" class="orang_terdekat" list-option=""
                    :label-required="true" :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <div class="form-group row">
                    <label for="" class="col-lg-3">PENDIDIKAN TERAKHIR</label>
                    <div class="col-lg-9">
                    <x-table class="table-bordered table-responsive mb-5">
                        <x-slot name="thead" class="thead-primary">
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">Jenjang Pendidikan</th>
                                <th width="10%">Nama Institusi</th>
                                <th width="10%">Jurusan</th>
                                <th width="10%">Tahun Lulus</th>
                                <th width="10%">IPK</th>
                            </tr>
                        </x-slot>

                        @foreach ($riwayatPendidikan as $key => $item)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$item->jenjang_pendidikan}}</td>
                                <td>{{$item->nama_institusi}}</td>
                                <td>{{$item->jurusan}}</td>
                                <td>{{$item->tahun_lulus}}</td>
                                <td>{{$item->ipk}}</td>
                            </tr>
                        @endforeach
                    </x-table>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group row">
                    <label for="" class="col-lg-3">RIWAYAT PELATIHAN</label>
                    <div class="col-lg-9">
                    <x-table class="table-bordered table-responsive mb-5">
                        <x-slot name="thead" class="thead-primary">
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">Nama Kursus/Seminar</th>
                                <th width="10%">Sertifikat (ada/tidak)</th>
                                <th width="10%">Tahun</th>
                            </tr>
                        </x-slot>

                        @foreach ($riwayatPelatihan as $key => $item)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$item->nama_pelatihan}}</td>
                                <td class="text-center"> <input type="checkbox" {{$item->sertifikat == true ? 'checked' : ''}} disabled></td>
                                <td>{{$item->tahun}}</td>
                            </tr>
                        @endforeach
                    </x-table>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group row">
                    <label for="" class="col-lg-3">RIWAYAT PEKERJAAN</label>
                    <div class="col-lg-9">
                    <x-table class="table-bordered table-responsive mb-5">
                        <x-slot name="thead" class="thead-primary">
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">Nama Perusahaan</th>
                                <th width="10%">Posisi Terakhir</th>
                                <th width="10%">Pendapatan Terakhir</th>
                                <th width="10%">Tahun</th>
                            </tr>
                        </x-slot>

                        @foreach ($riwayatPelatihan as $key => $item)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$item->nama_perusahaan}}</td>
                                <td>{{$item->posisi_terakhir}}</td>
                                <td>{{$item->pendapatan_terakhir}}</td>
                                <td>{{$item->tahun}}</td>
                            </tr>
                        @endforeach
                    </x-table>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="SKILL" value="{{ !empty($data->skill) ? $data->skill : old('skill') }}"
                    type="textarea" name="skill" id="skill" class="skill" list-option="" :label-required="true"
                    :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="BERSEDIA DITEMPATKAN DI SELURUH KANTOR PERUSAHAAN"
                    value="{{ !empty($data->bersedia) ? $data->bersedia : old('bersedia') }}" type="radio"
                    name="bersedia" id="bersedia" class="bersedia" :list-option="['YA' => 'YA', 'TIDAK' => 'TIDAK']" :label-required="true"
                    :disabled="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="PENGHASILAN YANG DIHARAPKAN PERBULAN"
                    value="{{ !empty($data->penghasilan_diharapkan) ? $data->penghasilan_diharapkan : old('penghasilan_diharapkan') }}"
                    type="text" name="penghasilan_diharapkan" id="penghasilan_diharapkan"
                    class="penghasilan_diharapkan" list-option="" :label-required="true"
                    :disabled="true"></x-form-input-inline>
            </div>
        </div>
    </x-card>


@endsection

@push('js')
    <script></script>
@endpush
