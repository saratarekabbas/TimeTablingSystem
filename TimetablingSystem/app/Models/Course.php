<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class); //means, one course can have many programs
    }

//    public function lecturers()
//    {
//        return $this->hasMany(Lecturer::class); //means, one course can have many programs
//    }


    protected $casts = [
        'program_package' => 'array'
    ];

}
