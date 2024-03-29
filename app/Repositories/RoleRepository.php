<?php

namespace App\Repositories;

use App\Models\Role;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Support\Collection;
use App\Models\Model;

class RoleRepository extends BaseRepository
{
    /**
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array<mixed> $attributes
     * @return Collection<int, Model>
     */
    public function all($attributes = []): Collection
    {
        return $this->model
            ->when(isset($attributes['name']) && $attributes['name'] != "", function ($query) use ($attributes) {
                $query->where('name', $attributes['name']);
            })
            ->get();
    }

    /**
     * @param string $name
     * @param string|null $guardName
     * @return SpatieRole
     */
    public function findByName(string $name, $guardName = null): SpatieRole
    {
        // @phpstan-ignore-next-line
        return SpatieRole::findByName($name, $guardName);
    }

    /**
     * @param string $role
     * @param array|mixed $permissions
     * @return SpatieRole
     */
    public function setRolePermissions(string $role, $permissions): SpatieRole
    {
        $role = $this->findByName($role);
        $role->syncPermissions($permissions);

        return $role;
    }

    /**
     *
     * @param  string  $role
     *
     * @return SpatieRole
     */
    public function getUsersByRole($role = null)
    {
        // @phpstan-ignore-next-line
        return SpatieRole::when(isset($role) && $role != "", function ($query) use ($role) {
                $query->whereIn('name', $role);
            })
            ->withCount('users')
            ->get();
    }
}
