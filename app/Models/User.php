<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illmuniate\Support\Facades\Request;
use App\Models\Log;
use App\Models\Admin;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_deleted',
        'is_inactive'
    ];
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'email', 'email');
    }

    public function studentName()
    {
        return $this->hasOne(Student::class, 'id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }
}
