<x-modal size="modal-md">
    <x-slot name="title"></x-slot>
    @method('post')

    <x-form-input label="Nama Kursus/Seminar" value="" type="text" name="nama_pelatihan" id="nama_pelatihan" class="nama_pelatihan" list-option="" :label-required="true"></x-form-input>

    <x-form-input label="Sertifikat (ada/tidak)" value="" type="checkbox" name="sertifikat" id="sertifikat" class="sertifikat" :list-option="['1' => 'Ada']" :label-required="true"></x-form-input>

    <x-form-input label="Tahun" value="" type="number" name="tahun" id="tahun" class="tahun" list-option="" :label-required="true"></x-form-input>

    <x-slot name="footer">
        <button class="btn btn-light" type="button" data-dismiss="modal">Batal</button>
        <button class="btn btn-primary" onclick="submitForm(this.form, this)">Save</button>
    </x-slot>
</x-modal>
