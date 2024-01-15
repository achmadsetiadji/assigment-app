<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = collect([
            'data biodata' => [
                'create data biodata',
                'view data biodata',
                'edit data biodata',
                'delete data biodata',
            ],
            'data riwayat pendidikan' => [
                'create data riwayat pendidikan',
                'view data riwayat pendidikan',
                'edit data riwayat pendidikan',
                'delete data riwayat pendidikan',
            ],
            'data riwayat pelatihan' => [
                'create data riwayat pelatihan',
                'view data riwayat pelatihan',
                'edit data riwayat pelatihan',
                'delete data riwayat pelatihan',
            ],
            'data riwayat pekerjaan' => [
                'create data riwayat pekerjaan',
                'view data riwayat pekerjaan',
                'edit data riwayat pekerjaan',
                'delete data riwayat pekerjaan',
            ],
        ]);

        $permissions->map(function ($permission, $group) {
            collect($permission)->map(function ($name) use ($group) {
                $guard_name = 'web';

                Permission::query()
                    ->updateOrCreate(compact('name'), compact('name', 'group', 'guard_name'));
            });
        });
    }
}
