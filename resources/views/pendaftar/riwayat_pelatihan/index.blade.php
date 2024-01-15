@extends('layouts.app')
@section('title', 'Data Riwayat Pelatihan')

@section('content')
    <x-card>
        <x-slot name="header" class="bg-white justify-content-between">
            <div class="row">
                <div class="col-lg-8">
                    <h5 class="card-title my-2">Data Riwayat Pelatihan</h5>
                    <p class="card-text">Tambahkan Data Riwayat Pelatihan dengan klik button tambah data</p>
                </div>
                <div class="col-lg-4">
                    @canany(['create data riwayat pelatihan'])
                        <button class="btn btn-info float-right"
                            onclick="addForm('{{ route('pendaftar.riwayat_pelatihan.store') }}', 'Tambah Data Riwayat Pelatihan')">
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
                <th width="10%">Nama Kursus/Seminar</th>
                <th width="10%">Sertifikat (ada/tidak)</th>
                <th width="10%">Tahun</th>
                <th width="10%">Aksi</th>
            </x-slot>
        </x-table>
    </x-card>

    @include('pendaftar.riwayat_pelatihan.form')
@endsection

@push('js')
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pendaftar.riwayat_pelatihan.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'nama_pelatihan'
                    },
                    {
                        data: 'sertifikat',
                        className: 'text-center'
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
