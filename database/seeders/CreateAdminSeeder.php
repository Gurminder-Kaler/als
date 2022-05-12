<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User();
        $user->name = "admin";
        $user->role = "admin";
        $user->email = "admin@admin.com";
        $user->password = "$2y$10$JNHONdunIbd88tCTmCp6ROoYsG.s9mhhDOC9HfJKJRg55qGJMs0UC";
        $user->gender = "male";
    }
}
