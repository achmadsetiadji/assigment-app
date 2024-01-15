<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        $data = collect([
            [
                'name' => "Admin",
                'email' => 'admin@gmail.com',
                'role' => 'admin'
            ],
        ]);

        $data->map(function ($data) {
            $name = $data['name'];
            $email = $data['email'];
            $role = $data['role'];
            $email_verified_at = now();
            $password = bcrypt('000000');

            $user = User::updateOrCreate([
                'email' => $email
            ], [
                'name'              => $name,
                'email'             => $email,
                'role'              => $role,
                'email_verified_at' => $email_verified_at,
                'password'          => $password
            ]);

            $user->syncRoles($user->role);
        });
    }
}
