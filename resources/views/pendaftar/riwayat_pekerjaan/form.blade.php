<x-modal size="modal-md">
    <x-slot name="title"></x-slot>
    @method('post')

    <x-form-input label="Nama Perusahaan" value="" type="text" name="nama_perusahaan" id="nama_perusahaan" class="nama_perusahaan" list-option="" :label-required="true"></x-form-input>

    <x-form-input label="Posisi Terakhir" value="" type="text" name="posisi_terakhir" id="posisi_terakhir" class="posisi_terakhir" list-option="" :label-required="true"></x-form-input>

    <x-form-input label="Pendapatan Terakhir" value="" type="number" name="pendapatan_terakhir" id="pendapatan_terakhir" class="pendapatan_terakhir" list-option="" :label-required="true"></x-form-input>

    <x-form-input label="Tahun" value="" type="number" name="tahun" id="tahun" class="tahun" list-option="" :label-required="true"></x-form-input>

    <x-slot name="footer">
        <button class="btn btn-light" type="button" data-dismiss="modal">Batal</button>
        <button class="btn btn-primary" onclick="submitForm(this.form, this)">Save</button>
    </x-slot>
</x-modal>
