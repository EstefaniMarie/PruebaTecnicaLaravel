<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $hashedPasswordRoot = bcrypt('12345678');
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'correo' => 'root@example.com',
                'password' => $hashedPasswordRoot,
                'roles_id' => 1
            ]
        ]);
    }
}


