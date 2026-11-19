<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //mass assignment
    protected $fillable = [
        'name',
        'email', 
        'phone',
        'address',
        'date_of_birth'
    ];

    protected $casts = [
        'date_of_birth' => 'date:Y-m-d',
    ];

    function age() : Attribute {
        return Attribute::make(
            get: fn () => $this->date_of_birth->age,
        );
    }
}
