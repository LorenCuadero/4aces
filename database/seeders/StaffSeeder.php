<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staffs')->insert([
            [
                'user_id' => 4,
                'first_name' => 'Jane',
                'middle_name' => 'N/A',
                'last_name' => 'Doe',
                'department' => 'Education',
                'birthdate' => '2001-10-05',
                'gender' => 'Female',
                'address' => 'Cebu',
                'civil_status' => 'Single',
                'contact_number' => "0900011111",
                'email' => '21103903@usc.edu.ph',
                'password' => bcrypt('Staffpassword'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'first_name' => 'Allan',
                'middle_name' => 'N/A',
                'last_name' => 'Celestial',
                'department' => 'Education',
                'birthdate' => '2001-10-05',
                'gender' => 'Male',
                'address' => 'Cebu',
                'civil_status' => 'Single',
                'contact_number' => "0900011111",
                'email' => '21103903@usc.edu.ph',
                'password' => bcrypt('Staffpassword'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
