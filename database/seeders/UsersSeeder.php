<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
        [
            "name" => '512',
            "email" => '512@123.com',
            "password" => Hash::make('123123123'),
        ],
       );
       User::insert(
        [
            "name" => '789',
            "email" => '789@123.com',
            "password" => Hash::make('123123123'),
        ],
       );
       
        
    
    }
}
