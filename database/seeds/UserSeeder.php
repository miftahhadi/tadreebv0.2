<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = User::create([
            'nama' => 'Root',
            'email' => 'ypiacademy.putra@gmail.com',
            'username' => 'root',
            'password' => Hash::make('mashdar-mimi'),
            'gender' => 1
        ]);

        $root->roles()->attach(1);

        $admin = User::create([
            'nama' => 'Admin',
            'email' => 'mahadumar.ypia@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('ma3qulelma3na'),
            'gender' => 1
        ]);

        $admin->roles()->attach(1);
    }
}
