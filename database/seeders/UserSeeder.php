<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id'=>Str::uuid(),
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role'=> 1,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('adminadmin'), // Hash password dengan Bcrypt
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'=>Str::uuid(),
                'name' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'role'=> 0,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('securepass'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
