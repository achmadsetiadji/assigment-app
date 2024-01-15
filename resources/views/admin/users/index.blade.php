@extends('layouts.app')
@section('title', 'Data User')

@section('content')
<x-card>
    <div class="row">
        <div class="col pr-lg-2 m-1">
            <x-card class="text-center bg-f2f2f2 cursor-pointer" data-role="">
                <div class="d-flex align-items-center justify-content-center">
                    <strong class="fs-30 mb-2 text-black">{{ format_uang($countAllUsersByRoles) }}</strong>
                    <p class="d-inline-block ml-2">Total User</p>
                </div>
            </x-card>
        </div>

        @foreach ($usersByRoles as $role)
        <div class="col pr-lg-2 m-1">
            <x-card class="text-center bg-f2f2f2 cursor-pointer" data-role="{{ $role->name }}">
                <div class="d-flex align-items-center justify-content-center">
                    <strong class="fs-30 mb-2 text-{{ auth()->user()->getRoleColor($role->name) }}">{{ format_uang($role->users_count) }}</strong>
                    <p class="d-inline-block ml-2 text-capitalize">{{ $role->name }}</p>
                </div>
            </x-card>
        </div>
        @endforeach
    </div>
</x-card>

<x-card class="mt-3">
    <x-slot name="header" class="bg-white border-bottom-0 d-flex justify-content-between">
        <h5 class="card-title mt-3 mb-3">Data User</h5>
        <button class="btn btn-primary" onclick="addForm('{{ route(auth()->user()->role.'.user.store') }}', 'Add User')">
            Add User
            <i class="fa-solid fa-plus"></i>
        </button>
    </x-slot>

    <x-table class="expandable-table table-responsive">
        <x-slot name="thead">
            <th width="5%">#</th>
            <th>Nama User</th>
            <th>Email</th>
            <th>Peranan User</th>
            <th width="15%">Aksi</th>
        </x-slot>
    </x-table>
</x-card>

@include('admin.users.form')
@endsection

@push('js')
<script>
    $("#provinsi-input").hide();
    $("#kabupaten-input").hide();

    let table;

    table = $('.table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            url: '{{ route(auth()->user()->role.'.user.data') }}',
        },
        "columnDefs": [
            { "orderable": false, "targets": 0 },
            { width: 20, targets: 0 }
        ],
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', searchable: false },
            {data: 'name'},
            {data: 'email'},
            {data: 'role', searchable: false, orderable: false, className: 'text-center'},
            {data: 'action', searchable: false, sortable: false},
        ]
    });

    $('[data-role]').on('click', function () {
        table.ajax.url(`{{ route(auth()->user()->role.'.user.data') }}?role=${this.dataset.role}`).load()
    })

    /**
     * Fungsi untuk menampilkan modal bootstrap
     * Set default attribute berdasarkan parameter yang dikirm
     *
     * @param {string} url
     * @param {string} title
     * @param {string} modal
     * @param {callback} func
     * @return void
     */
    function addForm(url, title = 'Tambah', modal = '#modal-form', func) {
        $("#provinsi-input").hide();
        $("#kabupaten-input").hide();

        $(`${modal}`).modal('show');
        $(`${modal} .modal-title`).text(title);
        $(`${modal} form`).attr('action', url);
        $(`${modal} [name=_method]`).val('post');

        resetForm(`${modal} form`);

        if (func != undefined) {
            func();
        }
    }

    /**
     * Fungsi untuk menampilkan modal bootstrap
     * Set default attribute berdasarkan parameter yang dikirm
     * Form akan terisi otomatis berdasarkan data yang diload via ajax
     *
     * @param {string} url
     * @param {string} title
     * @param {string} modal
     * @param {callback} func
     * @return void
     */
    function editForm(url, title = 'Edit', modal = '#modal-form', func) {
        $("#provinsi-input").hide();
        $("#kabupaten-input").hide();

        $.get(url)
            .done(response => {
                $(`${modal}`).modal('show');
                $(`${modal} .modal-title`).text(title);
                $(`${modal} form`).attr('action', url);
                $(`${modal} [name=_method]`).val('put');

                resetForm(`${modal} form`);
                loopForm(response.data);

                if (func != undefined) {
                    func(response.data);
                }
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }

    /**
     *
     * @param {string|NodeList} originalForm
     * @return void
     */
    function loopForm(originalForm) {
        for (field in originalForm) {
            if ($(`[name=${field}]`).attr('type') != 'file') {
                if ($(`[name=${field}]`).hasClass('summernote')) {
                    $(`[name=${field}]`).summernote('code', originalForm[field]);
                } else if ($(`[name=${field}]`).attr('type') == 'radio') { // radio
                    $(`[name=${field}]`).filter(`[value="${originalForm[field]}"]`).prop('checked', true);
                } else if ($(`[name=${field}]`).attr('type') == 'checkbox') { // checkbox
                    $(`[name=${field}]`).filter(`[value="${originalForm[field]}"]`).prop('checked', true);
                } else {
                    if ($(`[name=${field}]`).length == 0 && $(`[name="${field}[]"]`).attr('multiple')) { // select multiple
                        $(`[name="${field}[]"]`).val(originalForm[field]);
                    } else {
                        $(`[name=${field}]`).val(originalForm[field]);
                    }
                }

                if ($(`[name="${field}[]"]`).length > 1) { // checkbox multiple
                    originalForm[field].forEach(el => {
                        $(`[name="${field}[]"]`).filter(`[value="${el}"]`).prop('checked', true);
                    });
                }

                if (originalForm['role'] == 'kabko') {
                    showWilayah('kabko');
                } else if (originalForm['role'] == 'kanwil'){
                    showWilayah('kanwil');
                }

                //select2
                var select2 = $(`[name="${field}"]`).hasClass("select2");
                if (select2) {
                    $(`[name="${field}"]`).trigger("change");
                }

                //select2Multiple
                var select2Multiple = $(`[name="${field}[]"]`).hasClass("select2");
                if (
                    typeof select2Multiple !== "undefined" &&
                    select2Multiple !== false
                ) {
                    $(`[name="${field}[]"]`)
                        .val(originalForm[field].split(","))
                        .change();
                }

                //select wilayah
                if ($(`[name="${field}"]`).hasClass(`select-wilayah-provinsi`)) {
                    $(`[name="${field}"]`).data("value", originalForm[field]);
                }
                if ($(`[name="${field}"]`).hasClass(`select-wilayah-kabupaten`)) {
                    $(`[name="${field}"]`).data("value", originalForm[field]);
                }
                if ($(`[name="${field}"]`).hasClass(`select-wilayah-kecamatan`)) {
                    $(`[name="${field}"]`).data("value", originalForm[field]);
                }
                if ($(`[name="${field}"]`).hasClass(`select-wilayah-kelurahan`)) {
                    $(`[name="${field}"]`).data("value", originalForm[field]);
                }

            } else {
                $(`.preview-${field}`)
                    .attr('src', originalForm[field])
                    .show();
            }
        }
    }
</script>
@endpush
