@extends('layouts.app')
@section('title', 'Data Riwayat Pekerjaan')

@section('content')
    <x-card>
        <x-slot name="header" class="bg-white justify-content-between">
            <div class="row">
                <div class="col-lg-8">
                    <h5 class="card-title my-2">Data Riwayat Pekerjaan</h5>
                    <p class="card-text">Tambahkan Data Riwayat Pekerjaan dengan klik button tambah data</p>
                </div>
                <div class="col-lg-4">
                    @canany(['create data riwayat pekerjaan'])
                    <button class="btn btn-info float-right"
                        onclick="addForm('{{ route('pendaftar.riwayat_pekerjaan.store') }}', 'Tambah Data Riwayat Pekerjaan')">
                        Tambah Data
                        <i class="fa-solid fa-file-circle-plus"></i>
                    </button>
                    @endcanany
                </div>
            </div>
        </x-slot>

        <x-table class="expandable-table table-responsive">
            <x-slot name="thead">
                <th width="5%">#</th>
                <th width="10%">Nama Perusahaan</th>
                <th width="10%">Posisi Terakhir</th>
                <th width="10%">Pendapatan Terakhir</th>
                <th width="10%">Tahun</th>
                <th width="10%">Aksi</th>
            </x-slot>
        </x-table>
    </x-card>

    @include('pendaftar.riwayat_pekerjaan.form')
@endsection

@push('js')
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pendaftar.riwayat_pekerjaan.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'nama_perusahaan'
                    },
                    {
                        data: 'posisi_terakhir'
                    },
                    {
                        data: 'pendapatan_terakhir'
                    },
                    {
                        data: 'tahun'
                    },
                    {
                        data: 'action',
                        searchable: false,
                        sortable: false
                    },
                ]
            });
        });
    </script>
@endpush
