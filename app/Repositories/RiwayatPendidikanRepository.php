<?php

namespace App\Repositories;

use App\Models\RiwayatPendidikan;
use Illuminate\Support\Collection;

class RiwayatPendidikanRepository extends BaseRepository
{
    /**
     * @param RiwayatPendidikan $model
     */
    public function __construct(RiwayatPendidikan $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param   Array
     * @return  Collection
     */
    public function getWhere(array $attr = [
        ['column' => '', 'operator' => '', 'value' => '']
    ]): Collection
    {
        $data = $this->model
            ->leftJoin('biodatas', 'biodatas.id', 'riwayat_pendidikans.biodata_id')
            ->select(
                'riwayat_pendidikans.*',
            );

        foreach ($attr as $item) {
            $data->when($item['value'] != '', function ($w) use ($item) {
                $w->where($item['column'], $item['operator'], $item['value']);
            });
        }
        return $data->get();
    }
}
