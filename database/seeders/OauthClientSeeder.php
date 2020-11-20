<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OauthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            "name" => "123",
            "secret" => "123",
            "provider" => "admins",
            "redirect" => "http://localhost",
            "personal_access_client" => 0,
            "password_client" => 1,
            "revoked" => 0,
        ]);

        DB::table('oauth_clients')->insert([
            "name" => "234",
            "secret" => "234",
            "provider" => "users",
            "redirect" => "http://localhost",
            "personal_access_client" => 0,
            "password_client" => 1,
            "revoked" => 0,
        ]);
    }
}
