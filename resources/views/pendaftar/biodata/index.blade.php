@extends('layouts.app')
@section('title', 'Biodata Pendaftar')

@section('content')
<x-card>
    <x-slot name="header" class="bg-white justify-content-between">
        <h5 class="card-title my-2">Biodata Pendaftar</h5>
        <p class="card-text">Lengkapi Data Biodata Pendaftar dengan cara mengisi semua kolom dibawah ini</p>
    </x-slot>

    <form
        action="{{ !empty($data) ? route('pendaftar.biodata.update', $data->id) : route('pendaftar.biodata.store') }}"
        method="post" enctype="multipart/form-data"
        >
        @if (!empty($data))
            @method('PUT')
        @endif
        @csrf

        <div class="row">
            <div class="col-lg-12">
                <x-form-input-inline label="POSISI YANG DILAMAR" value="{{ !empty($data->position) ? $data->position : old('position') }}" type="text" name="position" id="position" class="position" list-option="" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="NAMA" value="{{ !empty($data->name) ? $data->name : old('name') }}" type="text" name="name" id="name" class="name" list-option="" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="NO. KTP" value="{{ !empty($data->no_ktp) ? $data->no_ktp : old('no_ktp') }}" type="number" name="no_ktp" id="no_ktp" class="no_ktp" list-option="" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="TEMPAT LAHIR" value="{{ !empty($data->tempat_lahir) ? $data->tempat_lahir : old('tempat_lahir') }}" type="text" name="tempat_lahir" id="tempat_lahir" class="tempat_lahir" list-option="" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="TANGGAL LAHIR" value="{{ !empty($data->tanggal_lahir) ? $data->tanggal_lahir : old('tanggal_lahir') }}" type="date" name="tanggal_lahir" id="tanggal_lahir" class="tanggal_lahir" list-option="" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="JENIS KELAMIN" value="{{ !empty($data->jenis_kelamin) ? $data->jenis_kelamin : old('jenis_kelamin') }}" type="radio" name="jenis_kelamin" id="jenis_kelamin" class="jenis_kelamin" :list-option="['LAKI-LAKI' => 'LAKI-LAKI', 'PEREMPUAN' => 'PEREMPUAN']" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="AGAMA" value="{{ !empty($data->agama) ? $data->agama : old('agama') }}" type="text" name="agama" id="agama" class="agama" list-option="" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="GOLONGAN DARAH" value="{{ !empty($data->gol_darah) ? $data->gol_darah : old('gol_darah') }}" type="text" name="gol_darah" id="gol_darah" class="gol_darah" list-option="" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="STATUS" value="{{ !empty($data->status) ? $data->status : old('status') }}" type="text" name="status" id="status" class="status" list-option="" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="ALAMAT KTP" value="{{ !empty($data->alamat_ktp) ? $data->alamat_ktp : old('alamat_ktp') }}" type="textarea" name="alamat_ktp" id="alamat_ktp" class="alamat_ktp" list-option="" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="ALAMAT TINGGAL" value="{{ !empty($data->alamat_tinggal) ? $data->alamat_tinggal : old('alamat_tinggal') }}" type="textarea" name="alamat_tinggal" id="alamat_tinggal" class="alamat_tinggal" list-option="" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="EMAIL" value="{{ !empty($data->email) ? $data->email : old('email') }}" type="email" name="email" id="email" class="email" list-option="" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="NO. TELP" value="{{ !empty($data->no_telepon) ? $data->no_telepon : old('no_telepon') }}" type="text" name="no_telepon" id="no_telepon" class="no_telepon" list-option="" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="ORANG TERDEKAT YANG DAPAT DIHUBUNGI" value="{{ !empty($data->orang_terdekat) ? $data->orang_terdekat : old('orang_terdekat') }}" type="text" name="orang_terdekat" id="orang_terdekat" class="orang_terdekat" list-option="" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="SKILL" value="{{ !empty($data->skill) ? $data->skill : old('skill') }}" type="textarea" name="skill" id="skill" class="skill" list-option="" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="BERSEDIA DITEMPATKAN DI SELURUH KANTOR PERUSAHAAN" value="{{ !empty($data->bersedia) ? $data->bersedia : old('bersedia') }}" type="radio" name="bersedia" id="bersedia" class="bersedia" :list-option="['YA' => 'YA', 'TIDAK' => 'TIDAK']" :label-required="true"></x-form-input-inline>
            </div>

            <div class="col-lg-12">
                <x-form-input-inline label="PENGHASILAN YANG DIHARAPKAN PERBULAN" value="{{ !empty($data->penghasilan_diharapkan) ? $data->penghasilan_diharapkan : old('penghasilan_diharapkan') }}" type="text" name="penghasilan_diharapkan" id="penghasilan_diharapkan" class="penghasilan_diharapkan" list-option="" :label-required="true"></x-form-input-inline>
            </div>
        </div>

        @canany(['create data biodata', 'edit data biodata'])
        <button onclick="submitForm(this.form, this, {reload: true, redirectTo: ''} )" class="btn btn-info mt-3 float-right">Simpan</button>
        @endcanany
    </form>
</x-card>
@endsection

@push('js')
<script>

</script>
@endpush
