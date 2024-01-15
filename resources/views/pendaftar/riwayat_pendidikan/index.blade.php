@extends('layouts.app')
@section('title', 'Data Riwayat Pendidikan')

@section('content')
    <x-card>
        <x-slot name="header" class="bg-white justify-content-between">
            <div class="row">
                <div class="col-lg-8">
                    <h5 class="card-title my-2">Data Riwayat Pendidikan</h5>
                    <p class="card-text">Tambahkan Data Riwayat Pendidikan dengan klik button tambah data</p>
                </div>
                <div class="col-lg-4">
                    @canany(['create data riwayat pendidikan'])
                    <button class="btn btn-info float-right"
                        onclick="addForm('{{ route('pendaftar.riwayat_pendidikan.store') }}', 'Tambah Data Riwayat Pendidikan')">
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
                <th width="10%">Jenjang Pendidikan</th>
                <th width="10%">Nama Institusi</th>
                <th width="10%">Jurusan</th>
                <th width="10%">Tahun Lulus</th>
                <th width="10%">IPK</th>
                <th width="10%">Aksi</th>
            </x-slot>
        </x-table>
    </x-card>

    @include('pendaftar.riwayat_pendidikan.form')
@endsection

@push('js')
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pendaftar.riwayat_pendidikan.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'jenjang_pendidikan'
                    },
                    {
                        data: 'nama_institusi'
                    },
                    {
                        data: 'jurusan'
                    },
                    {
                        data: 'tahun_lulus'
                    },
                    {
                        data: 'ipk'
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
