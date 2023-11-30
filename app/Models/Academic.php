<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Academic extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_code',
        'student_id',
        'year_and_sem',
        'midterm_grade',
        'final_grade',
        'gpa',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
