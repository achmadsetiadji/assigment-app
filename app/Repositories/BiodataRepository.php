<?php

namespace App\Repositories;

use App\Models\Biodata;
use Illuminate\Support\Collection;

class BiodataRepository extends BaseRepository
{
    /**
     * @param Biodata $model
     */
    public function __construct(Biodata $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model
            ->select(
                'biodatas.*',
            )
            ->get();
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
            ->select(
                'biodatas.*',
            );

        foreach ($attr as $item) {
            $data->when($item['value'] != '', function ($w) use ($item) {
                $w->where($item['column'], $item['operator'], $item['value']);
            });
        }
        return $data->get();
    }
}
