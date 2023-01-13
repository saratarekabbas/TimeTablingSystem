<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Program::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

}
