<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dob',
        'email',
        'contact_number',
        'age',
        'profile_picture'
    ];

    protected $casts = [
        'dob' => 'date',
    ];
}
