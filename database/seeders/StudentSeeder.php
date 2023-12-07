<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    public function run()
    {

       DB::table('students')->insert([
            [
                'user_id' => 4,
                'first_name' => 'Student',
                'middle_name' => 'N/A',
                'last_name' => 'Test',
                'gender' => 'Male',
                'email' => 'lorencuadero8@gmail.com',
                'password' => bcrypt('Studentpassword'),
                'contact_number' => '123456789',
                'birthdate' => Carbon::now()->subYears(20)->format('Y-m-d'),
                'address' => '123 Main St., Anytown USA',
                'parent_name' => 'Jane Smith',
                'parent_contact' => '0987654321',
                'batch_year' => '2020',
                'joined' => Carbon::now()->subYears(1)->format('Y-m-d'),
            ],
        ]);

    }
}
