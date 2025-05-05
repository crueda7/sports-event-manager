<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Carlos Rueda',
                'email' => 'crueda18@udi.edu.co',
                'password' => Hash::make('crueda18'),
                'role_id' => 1,
            ],
            [
                'name' => 'Marlon Garcia',
                'email' => 'mgarcia29@udi.edu.co',
                'password' => Hash::make('mgarcia29'),
                'role_id' => 1,
            ]
        ]);
    }
}
