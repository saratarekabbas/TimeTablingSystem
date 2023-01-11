<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    public function courses()
    {
        return $this->hasMany(Course::class); //means, one lecturer can have many courses
    }
}
