<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'department',
        'birthdate',
        'gender',
        'address',
        'civil_status',
        'contact_number',
        'email',
        'password'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function log()
    {
        return $this->hasMany(Log::class);
    }
}
