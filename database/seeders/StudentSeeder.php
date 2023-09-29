<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    public function run()
    {
        DB::table('students')->truncate();

        $students = [
            [
                'name' => 'John Doe',
                'batch_year' => '2020',
                'joined' => Carbon::now()->subYears(1)->format('Y-m-d H:i:s'),
                'gpa' => '1.0',
                'status' => 'active',
                'verbal_warning' => null,
                'written_warning' => null,
                'provisionary' => null,
            ],
            [
                'name' => 'Jane Smith',
                'batch_year' => '2019',
                'joined' => Carbon::now()->subYears(2)->format('Y-m-d H:i:s'),
                'gpa' => '1.1',
                'status' => 'inactive',
                'verbal_warning' => null,
                'written_warning' => null,
                'provisionary' => null,
            ],
            [
                'name' => 'Bob Johnson',
                'batch_year' => '2021',
                'joined' => Carbon::now()->subMonths(6)->format('Y-m-d H:i:s'),
                'gpa' => '1.2',
                'status' => 'active',
                'verbal_warning' => null,
                'written_warning' => null,
                'provisionary' => null,
            ]
        ];

        foreach ($students as $student) {
            DB::table('students')->insert([
                'name' => $student['name'],
                'batch_year' => $student['batch_year'],
                'joined' => $student['joined'],
                'gpa' => $student['gpa'],
                'status' => $student['status'],
                'verbal_warning' => $student['verbal_warning'],
                'written_warning' => $student['written_warning'],
                'provisionary' => $student['provisionary'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}