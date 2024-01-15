<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use App\Http\Requests\RiwayatPendidikanRequest;
use App\Repositories\RiwayatPendidikanRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatPendidikanController extends Controller
{
    private $riwayatPedidikan;

    /**
     * @param Request $request
     */
    public function __construct(
        RiwayatPendidikanRepository $riwayatPedidikan,
    ) {
        $this->riwayatPedidikan = $riwayatPedidikan;
    }

    /**
     * Menampilkan halaman data_pendidik/index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pendaftar.riwayat_pendidikan.index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $data = $this->riwayatPedidikan->getWhere([
            ['column' => 'riwayat_pendidikans.biodata_id', 'operator' => '=', 'value' => auth()->user()->biodata->id],
        ]);

        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $buttons = '';

                if (auth()->user()->can('edit data riwayat pendidikan')) {
                    $buttons .= "
                        <button class='btn btn-warning text-white'
                            onclick='editForm(`" . route('pendaftar.riwayat_pendidikan.show', $data->id) . "`, `Edit Riwayat Pendidikan`)'>
                            <i class='ti-pencil'></i>
                            Edit
                        </button>";
                }

                if (auth()->user()->can('delete data riwayat pendidikan')) {
                    $buttons .= "
                        <button class='btn btn-danger'
                            onclick='deleteData(`" . route('pendaftar.riwayat_pendidikan.destroy', $data->id) . "`)'>
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
     * @param RiwayatPendidikanRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RiwayatPendidikanRequest $request)
    {
        DB::beginTransaction();
        try {
            $attributes = $request->all();

            $attributes['biodata_id'] = auth()->user()->biodata->id;

            $riwayatPedidikan = $this->riwayatPedidikan->create($attributes);

            DB::commit();
            return $this->ok($riwayatPedidikan, 'Riwayat Pendidikan berhasil ditambahkan');
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
        $riwayatPedidikan = $this->riwayatPedidikan->find($id);

        if (!$riwayatPedidikan) {
            return $this->oops('Riwayat Pendidikan tidak ditemukan');
        }

        return $this->ok($riwayatPedidikan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RiwayatPendidikanRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(RiwayatPendidikanRequest $request, $id)
    {
        $riwayatPedidikan = $this->riwayatPedidikan->find($id);
        if (!$riwayatPedidikan) {
            return $this->oops('Riwayat Pendidikan tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            $attributes = $request->all();

            $attributes['biodata_id'] = auth()->user()->biodata->id;

            $riwayatPedidikan = $this->riwayatPedidikan->update($attributes, $id);

            DB::commit();
            return $this->ok($riwayatPedidikan, 'Riwayat Pendidikan berhasil diupdate');
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
            $riwayatPedidikan = $this->riwayatPedidikan->find($id);
            if (!$riwayatPedidikan) {
                return $this->oops('Riwayat Pendidikan tidak ditemukan.');
            }

            $this->riwayatPedidikan->delete($riwayatPedidikan->id);

            DB::commit();
            return $this->ok(null, 'Riwayat Pendidikan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }
}
