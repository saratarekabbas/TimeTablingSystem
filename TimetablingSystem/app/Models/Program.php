<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
/*    Property casts will take the array as a value, and for any column that we pass inside there, it will cast it into a certain data type back-and-forth
      AKA: it will let Eloquent know that when it fetches data from the database,
      it will have to convert the 'program_package' column value to an array.
*/
    protected $casts = [
        'program_package' => 'array'
    ];
}
