<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'department',
        'gender',
        'address',
        'civil_status',
        'contact_number',
        'email',
        'password'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
