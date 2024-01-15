<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidasiBiodata
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $data =
            auth()->user()->biodata->position &&
            auth()->user()->biodata->name &&
            auth()->user()->biodata->no_ktp &&
            auth()->user()->biodata->tempat_lahir &&
            auth()->user()->biodata->tanggal_lahir &&
            auth()->user()->biodata->jenis_kelamin &&
            auth()->user()->biodata->agama &&
            auth()->user()->biodata->gol_darah &&
            auth()->user()->biodata->status &&
            auth()->user()->biodata->alamat_ktp &&
            auth()->user()->biodata->alamat_tinggal &&
            auth()->user()->biodata->email &&
            auth()->user()->biodata->no_telepon &&
            auth()->user()->biodata->orang_terdekat &&
            auth()->user()->biodata->skill &&
            auth()->user()->biodata->bersedia &&
            auth()->user()->biodata->penghasilan_diharapkan
            ? true : false;

        if (!$data) {
            return redirect()->route('pendaftar.biodata.index')
                ->with(
                    'warning_msg',
                    'Anda harus melengkapi data biodata terlebih dahulu untuk menuju ke menu selanjutnya'
                );
        }

        return $next($request);
    }
}
