<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(
            ['tipe' => 'Admin']
        );

        $teacher = Role::create(
            ['tipe' => 'Teacher']
        );

        $peserta = Role::create(
            ['tipe' => 'Peserta']
        );
    }
}
