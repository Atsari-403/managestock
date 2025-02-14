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
                'id' =>Str::uuid(),
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('adminadmin'), // Hash password dengan Bcrypt
                'remember_token' => Str::random(10),
                'role'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>Str::uuid(),
                'name' => 'staff',
                'email' => 'staff@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('staffstaff'), // Hash password dengan Bcrypt
                'remember_token' => Str::random(10),
                'role'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
