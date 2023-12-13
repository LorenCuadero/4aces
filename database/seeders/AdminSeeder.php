<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'user_id' => 1,
                'first_name' => 'Michelle',
                'middle_name' => 'N/A',
                'last_name' => 'Maglapus',
                'department' => 'Administrative & Finance',
                'birthdate' => '2001-10-05',
                'gender' => 'Female',
                'address' => 'Cebu',
                'civil_status' => 'Single',
                'contact_number' => "0900011111",
                'email' => 'mchllmglps@gmail.com',
                'password' => bcrypt('Adminpassword'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'first_name' => 'Lorenfe',
                'middle_name' => 'N/A',
                'last_name' => 'Cuadero',
                'department' => 'Administrative & Finance',
                'birthdate' => '2001-10-05',
                'gender' => 'Female',
                'address' => 'Cebu',
                'civil_status' => 'Single',
                'contact_number' => "0900011111",
                'email' => 'lorenfe.cuadero@student.passerellesnumeriques.org',
                'password' => bcrypt('Adminpassword'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'first_name' => 'Allan',
                'middle_name' => 'Celestial',
                'last_name' => 'Divino',
                'department' => 'Administrative & Finance',
                'birthdate' => '2001-10-05',
                'gender' => 'Male',
                'address' => 'Cebu',
                'civil_status' => 'Single',
                'contact_number' => "0900011111",
                'email' => 'drystanjoe@gmail.com',
                'password' => bcrypt('Adminpassword'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
