<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use App\Http\Requests\RiwayatPelatihanRequest;
use App\Repositories\RiwayatPelatihanRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatPelatihanController extends Controller
{
    private $riwayatPelatihan;

    /**
     * @param Request $request
     */
    public function __construct(
        RiwayatPelatihanRepository $riwayatPelatihan,
    ) {
        $this->riwayatPelatihan = $riwayatPelatihan;
    }

    /**
     * Menampilkan halaman data_pendidik/index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pendaftar.riwayat_pelatihan.index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $data = $this->riwayatPelatihan->getWhere([
            ['column' => 'riwayat_pelatihans.biodata_id', 'operator' => '=', 'value' => auth()->user()->biodata->id],
        ]);

        return datatables($data)
            ->addIndexColumn()
            ->addColumn('sertifikat', function ($data) {
                if ($data->sertifikat == true) {
                    return '<input type="checkbox" checked disabled>';
                }
                return '<input type="checkbox" disabled>';
            })
            ->addColumn('action', function ($data) {
                $buttons = '';

                if (auth()->user()->can('edit data riwayat pelatihan')) {
                    $buttons .= "
                            <button class='btn btn-warning text-white'
                                onclick='editForm(`" . route('pendaftar.riwayat_pelatihan.show', $data->id) . "`, `Edit Riwayat Pelatihan`)'>
                                <i class='ti-pencil'></i>
                                Edit
                            </button>";
                }

                if (auth()->user()->can('delete data riwayat pelatihan')) {
                    $buttons .= "
                            <button class='btn btn-danger'
                                onclick='deleteData(`" . route('pendaftar.riwayat_pelatihan.destroy', $data->id) . "`)'>
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
     * @param RiwayatPelatihanRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RiwayatPelatihanRequest $request)
    {
        DB::beginTransaction();
        try {
            $attributes = $request->except('sertifikat');
            $attributes['sertifikat'] = $request->sertifikat != null ? true : false;

            $attributes['biodata_id'] = auth()->user()->biodata->id;

            $riwayatPelatihan = $this->riwayatPelatihan->create($attributes);

            DB::commit();
            return $this->ok($riwayatPelatihan, 'Riwayat Pelatihan berhasil ditambahkan');
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
        $riwayatPelatihan = $this->riwayatPelatihan->find($id);

        if (!$riwayatPelatihan) {
            return $this->oops('Riwayat Pelatihan tidak ditemukan');
        }

        return $this->ok($riwayatPelatihan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RiwayatPelatihanRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(RiwayatPelatihanRequest $request, $id)
    {
        $riwayatPelatihan = $this->riwayatPelatihan->find($id);
        if (!$riwayatPelatihan) {
            return $this->oops('Riwayat Pelatihan tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            $attributes = $request->except('sertifikat');
            $attributes['sertifikat'] = $request->sertifikat != null ? true : false;

            $attributes['biodata_id'] = auth()->user()->biodata->id;

            $riwayatPelatihan = $this->riwayatPelatihan->update($attributes, $id);

            DB::commit();
            return $this->ok($riwayatPelatihan, 'Riwayat Pelatihan berhasil diupdate');
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
            $riwayatPelatihan = $this->riwayatPelatihan->find($id);
            if (!$riwayatPelatihan) {
                return $this->oops('Riwayat Pelatihan tidak ditemukan.');
            }

            $this->riwayatPelatihan->delete($riwayatPelatihan->id);

            DB::commit();
            return $this->ok(null, 'Riwayat Pelatihan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }
}
