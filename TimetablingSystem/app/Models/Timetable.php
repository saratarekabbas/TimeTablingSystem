<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    public function holidays()
    {
        return $this->hasMany(PublicHoliday::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function venues()
    {
        return $this->hasMany(Venue::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    protected $casts = [
        'slots' => 'array'
    ];
}
