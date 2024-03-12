<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // untuk pegawai / admin
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);

        // untuk owner 
        User::create([
            'name' => 'owner',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('owner'),
            'role' => 'owner'
        ]);
    }
}
