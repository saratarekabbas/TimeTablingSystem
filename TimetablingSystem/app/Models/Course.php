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

    protected $casts = [
        'course_type' => 'array',
        'course_section' => 'array'
    ];

}
