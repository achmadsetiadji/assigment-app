<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use App\Http\Requests\BiodataRequest;
use App\Repositories\BiodataRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BiodataController extends Controller
{
    protected $biodata;

    public function __construct(
        BiodataRepository $biodata,
    ) {
        $this->biodata = $biodata;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->biodata->find(auth()->user()->biodata->id);
        return view('pendaftar.biodata.index', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BiodataRequest $request, $id)
    {
        $biodata = $this->biodata->find($id);
        if (!$biodata) {
            return $this->oops('Biodata Pendaftar tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            $this->biodata->update($request->all(), $id);

            DB::commit();
            return $this->ok($biodata, 'Biodata Pendaftar berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }
}
