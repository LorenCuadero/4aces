<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    public function run()
    {
        DB::table('students')->delete();

        $students = [
            [
                'user_id' => 4,
                'first_name' => 'Student',
                'middle_name' => 'N/A',
                'last_name' => 'Test',
                'email' => 'lorencuadero8@gmail.com',
                'phone' => '123456789',
                'birthdate' => Carbon::now()->subYears(20)->format('Y-m-d'),
                'address' => '123 Main St., Anytown USA',
                'parent_name' => 'Jane Smith',
                'parent_contact' => '987654321',
                'batch_year' => '2020',
                'joined' => Carbon::now()->subYears(1)->format('Y-m-d'),
            ],
        ];

        foreach ($students as $student) {
            DB::table('students')->insert([
                'first_name' => $student['first_name'],
                'middle_name' => $student['middle_name'],
                'last_name' => $student['last_name'],
                'email' => $student['email'],
                'phone' => $student['phone'],
                'birthdate' => $student['birthdate'],
                'address' => $student['address'],
                'parent_name' => $student['parent_name'],
                'parent_contact' => $student['parent_contact'],
                'batch_year' => $student['batch_year'],
                'joined' => $student['joined'],
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
