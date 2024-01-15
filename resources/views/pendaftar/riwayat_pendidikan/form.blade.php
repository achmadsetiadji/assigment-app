<x-modal size="modal-md">
    <x-slot name="title"></x-slot>
    @method('post')

    @php
        $pendidikanTerakhir = [
            '' => 'Pilih Pendidikan Terakhir',
            "SD" => "SD",
            "SMP" => "SMP",
            "SMA" => "SMA",
            "D1" => "D1",
            "D2" => "D2",
            "D3" => "D3",
            "D4" => "D4",
            "S1" => "S1",
            "S2" => "S2",
            "S3" => "S3",
        ];
    @endphp
    <x-form-input label="Jenjang Pendidikan" value="" type="select" name="jenjang_pendidikan" id="jenjang_pendidikan" class="jenjang_pendidikan select2" :list-option="$pendidikanTerakhir" :label-required="true"></x-form-input>

    <x-form-input label="Nama Institusi" value="" type="text" name="nama_institusi" id="nama_institusi" class="nama_institusi" list-option="" :label-required="true"></x-form-input>

    <x-form-input label="Jurusan" value="" type="text" name="jurusan" id="jurusan" class="jurusan" list-option="" :label-required="true"></x-form-input>

    <x-form-input label="Tahun Lulus" value="" type="number" name="tahun_lulus" id="tahun_lulus" class="tahun_lulus" list-option="" :label-required="true"></x-form-input>

    <x-form-input label="IPK" value="" type="number" name="ipk" id="ipk" class="ipk" list-option="" :label-required="true"></x-form-input>

    <x-slot name="footer">
        <button class="btn btn-light" type="button" data-dismiss="modal">Batal</button>
        <button class="btn btn-primary" onclick="submitForm(this.form, this)">Save</button>
    </x-slot>
</x-modal>
