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
                'user_id' => 5,
                'first_name' => 'Hannah',
                'middle_name' => 'N/A',
                'last_name' => 'Montana',
                'gender' => 'Female',
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
            [
                'user_id' => 6,
                'first_name' => 'Allan',
                'middle_name' => 'N/A',
                'last_name' => 'Divino',
                'gender' => 'Male',
                'email' => 'allan.divino@student.passerellesnumeriques.org',
                'password' => bcrypt('Studentpassword'),
                'contact_number' => '09123456789',
                'birthdate' => Carbon::now()->subYears(20)->format('Y-m-d'),
                'address' => '123 Main St., Anytown USA',
                'parent_name' => 'John Doe',
                'parent_contact' => '0987654321',
                'batch_year' => '2020',
                'joined' => Carbon::now()->subYears(1)->format('Y-m-d'),
            ],
        ]);

    }
}
