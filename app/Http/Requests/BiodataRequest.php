<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BiodataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'position' => 'required',
            'name' => 'required',
            'no_ktp' => 'required|max:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'gol_darah' => 'required',
            'status' => 'required',
            'alamat_ktp' => 'required',
            'alamat_tinggal' => 'required',
            'email' => 'required|email|',
            'no_telepon' => 'required',
            'orang_terdekat' => 'required',
            'skill' => 'required',
            'bersedia' => 'required',
            'penghasilan_diharapkan' => 'required',
        ];
    }
}
