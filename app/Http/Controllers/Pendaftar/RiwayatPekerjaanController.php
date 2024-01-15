<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use App\Http\Requests\RiwayatPekerjaanRequest;
use App\Repositories\RiwayatPekerjaanRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatPekerjaanController extends Controller
{
    private $riwayatPekerjaan;

    /**
     * @param Request $request
     */
    public function __construct(
        RiwayatPekerjaanRepository $riwayatPekerjaan,
    ) {
        $this->riwayatPekerjaan = $riwayatPekerjaan;
    }

    /**
     * Menampilkan halaman data_pendidik/index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pendaftar.riwayat_pekerjaan.index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $data = $this->riwayatPekerjaan->getWhere([
            ['column' => 'riwayat_pekerjaans.biodata_id', 'operator' => '=', 'value' => auth()->user()->biodata->id],
        ]);

        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $buttons = '';

                if (auth()->user()->can('edit data riwayat pekerjaan')) {
                    $buttons .= "
                    <button class='btn btn-warning text-white'
                        onclick='editForm(`" . route('pendaftar.riwayat_pekerjaan.show', $data->id) . "`, `Edit Riwayat Pekerjaan`)'>
                        <i class='ti-pencil'></i>
                        Edit
                    </button>";
                }

                if (auth()->user()->can('delete data riwayat pekerjaan')) {
                    $buttons .= "
                    <button class='btn btn-danger'
                        onclick='deleteData(`" . route('pendaftar.riwayat_pekerjaan.destroy', $data->id) . "`)'>
                        <i class='ti-trash'></i>
                        Delete
                    </button>";
                }

                return $buttons;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RiwayatPekerjaanRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RiwayatPekerjaanRequest $request)
    {
        DB::beginTransaction();
        try {
            $attributes = $request->all();

            $attributes['biodata_id'] = auth()->user()->biodata->id;

            $riwayatPekerjaan = $this->riwayatPekerjaan->create($attributes);

            DB::commit();
            return $this->ok($riwayatPekerjaan, 'Riwayat Pekerjaan berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $riwayatPekerjaan = $this->riwayatPekerjaan->find($id);

        if (!$riwayatPekerjaan) {
            return $this->oops('Riwayat Pekerjaan tidak ditemukan');
        }

        return $this->ok($riwayatPekerjaan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RiwayatPekerjaanRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(RiwayatPekerjaanRequest $request, $id)
    {
        $riwayatPekerjaan = $this->riwayatPekerjaan->find($id);
        if (!$riwayatPekerjaan) {
            return $this->oops('Riwayat Pekerjaan tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            $attributes = $request->all();

            $attributes['biodata_id'] = auth()->user()->biodata->id;

            $riwayatPekerjaan = $this->riwayatPekerjaan->update($attributes, $id);

            DB::commit();
            return $this->ok($riwayatPekerjaan, 'Riwayat Pekerjaan berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $riwayatPekerjaan = $this->riwayatPekerjaan->find($id);
            if (!$riwayatPekerjaan) {
                return $this->oops('Riwayat Pekerjaan tidak ditemukan.');
            }

            $this->riwayatPekerjaan->delete($riwayatPekerjaan->id);

            DB::commit();
            return $this->ok(null, 'Riwayat Pekerjaan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }
}
