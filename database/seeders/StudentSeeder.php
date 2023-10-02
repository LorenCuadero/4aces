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
                'first_name' => 'John',
                'middle_name' => 'Doe',
                'last_name' => 'Smith',
                'email' => 'johndoe@example.com',
                'phone' => '123456789',
                'birthdate' => Carbon::now()->subYears(20)->format('Y-m-d'),
                'address' => '123 Main St., Anytown USA',
                'parent_name' => 'Jane Smith',
                'parent_contact' => '987654321',
                'payable_status' => 'paid',
                'account_status' => 'active',
                'batch_year' => '2020',
                'joined' => Carbon::now()->subYears(1)->format('Y-m-d'),
            ],
            [
                'first_name' => 'Jane',
                'middle_name' => '',
                'last_name' => 'Smith',
                'email' => 'janesmith@example.com',
                'phone' => '987654321',
                'birthdate' => Carbon::now()->subYears(22)->format('Y-m-d'),
                'address' => '456 Main St., Anytown USA',
                'parent_name' => 'Bob Johnson',
                'parent_contact' => '123456789',
                'payable_status' => 'unpaid',
                'account_status' => 'closed',
                'batch_year' => '2019',
                'joined' => Carbon::now()->subYears(2)->format('Y-m-d'),
            ],
            [
                'first_name' => 'Bob',
                'middle_name' => '',
                'last_name' => 'Johnson',
                'email' => 'bobjohnson@example.com',
                'phone' => '5551234',
                'birthdate' => Carbon::now()->subYears(18)->format('Y-m-d'),
                'address' => '789 Main St., Anytown USA',
                'parent_name' => 'John Doe',
                'parent_contact' => '5555678',
                'payable_status' => 'paid',
                'account_status' => 'active',
                'batch_year' => '2021',
                'joined' => Carbon::now()->subMonths(6)->format('Y-m-d'),
            ]
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
                'payable_status' => $student['payable_status'],
                'account_status' => $student['account_status'],
                'batch_year' => $student['batch_year'],
                'joined' => $student['joined'],
                'updated_at' => Carbon::now()
            ]);
        }
    }
}