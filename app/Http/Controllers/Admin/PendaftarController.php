<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BiodataRepository;
use App\Repositories\RiwayatPekerjaanRepository;
use App\Repositories\RiwayatPelatihanRepository;
use App\Repositories\RiwayatPendidikanRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftarController extends Controller
{
    protected $biodata;
    protected $riwayatPendidikan;
    protected $riwayatPelatihan;
    protected $riwayatPekerjaan;

    public function __construct(
        BiodataRepository $biodata,
        RiwayatPendidikanRepository $riwayatPendidikan,
        RiwayatPelatihanRepository $riwayatPelatihan,
        RiwayatPekerjaanRepository $riwayatPekerjaan
    ) {
        $this->biodata = $biodata;
        $this->riwayatPendidikan = $riwayatPendidikan;
        $this->riwayatPelatihan = $riwayatPelatihan;
        $this->riwayatPekerjaan = $riwayatPekerjaan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pendaftar.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $data = $this->biodata->all();

        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return "
                <a class='btn btn-warning text-white'
                    href=" . route('admin.pendaftar.show', $data->id) . ">
                    <i class='ti-eye'></i>
                    Show
                </a>

                <button class='btn btn-danger'
                    onclick='deleteData(`" . route('admin.pendaftar.destroy', $data->id) . "`)'>
                    <i class='ti-trash'></i>
                    Delete
                </button>
                ";
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->biodata->find($id);
        if (!$data) {
            return $this->oops('Pendaftar tidak ditemukan.');
        }

        $riwayatPendidikan = $this->riwayatPendidikan->getWhere([
            ['column' => 'riwayat_pendidikans.biodata_id', 'operator' => '=', 'value' => $id],
        ]);

        $riwayatPelatihan = $this->riwayatPelatihan->getWhere([
            ['column' => 'riwayat_pelatihans.biodata_id', 'operator' => '=', 'value' => $id],
        ]);

        $riwayatPekerjaan = $this->riwayatPekerjaan->getWhere([
            ['column' => 'riwayat_pekerjaans.biodata_id', 'operator' => '=', 'value' => $id],
        ]);

        return view('admin.pendaftar.show', compact(
            'data',
            'riwayatPendidikan',
            'riwayatPelatihan',
            'riwayatPekerjaan'
        ));
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
            $biodata = $this->biodata->find($id);
            if (!$biodata) {
                return $this->oops('Pendaftar tidak ditemukan.');
            }

            $this->riwayatPendidikan->deleteWhere('biodata_id', $id);
            $this->riwayatPelatihan->deleteWhere('biodata_id', $id);
            $this->riwayatPekerjaan->deleteWhere('biodata_id', $id);

            DB::commit();
            return $this->ok(null, 'Riwayat Pekerjaan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }
}
