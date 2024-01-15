@extends('layouts.app')
@section('title', 'Data Pendaftar')

@section('content')
    <x-card>
        <x-slot name="header" class="bg-white justify-content-between">
            <div class="row">
                <div class="col-lg-8">
                    <h5 class="card-title my-2">Data Pendaftar</h5>
                </div>
                <div class="col-lg-4">

                </div>
            </div>
        </x-slot>

        <x-table class="expandable-table table-responsive">
            <x-slot name="thead">
                <th width="5%">#</th>
                <th width="10%">Nama</th>
                <th width="10%">Posisi Dilamar</th>
                <th width="10%">Tempat Lahir</th>
                <th width="10%">Tanggal Lahir</th>
                <th width="10%">Aksi</th>
            </x-slot>
        </x-table>
    </x-card>

    {{-- @include('admin.pendaftar.show') --}}
@endsection

@push('js')
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('admin.pendaftar.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'position'
                    },
                    {
                        data: 'tempat_lahir'
                    },
                    {
                        data: 'tanggal_lahir'
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
