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
                'name' => 'John Doe',
                'email' => 'jokoa@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('adminadmin'), // Hash password dengan Bcrypt
                'remember_token' => Str::random(10),
                'role'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>Str::uuid(),
                'name' => 'Jane Smith',
                'email' => 'janesmithb@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('securepass'),
                'remember_token' => Str::random(10),
                'role'=> 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>Str::uuid(),
                'name' => 'John Doe',
                'email' => 'jokoc@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('adminadmin'), // Hash password dengan Bcrypt
                'remember_token' => Str::random(10),
                'role'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>Str::uuid(),
                'name' => 'Jane Smith',
                'email' => 'janesmithd@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('securepass'),
                'remember_token' => Str::random(10),
                'role'=> 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>Str::uuid(),
                'name' => 'John Doe',
                'email' => 'jokod@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('adminadmin'), // Hash password dengan Bcrypt
                'remember_token' => Str::random(10),
                'role'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' =>Str::uuid(),
                'name' => 'Jane Smith',
                'email' => 'janesmithf@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('securepass'),
                'remember_token' => Str::random(10),
                'role'=> 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
