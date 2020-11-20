<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserType::insert([
            'ic' => '123',
            'user_type' => 'App\Models\Admin',
        ]);

        UserType::insert([
            'ic' => '234',
            'user_type' => 'App\Models\User',
        ]);
    }
}
