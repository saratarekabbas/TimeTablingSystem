<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
/*    this will let Eloquent know that when it fetches data from the database,
      it will have to convert the 'program_package' column value to an array. This is only
      emulating an actual array, as at the database level the column is of type
      TEXT and the array is serialized. However, when unserializing the column value,
      Eloquent returns an actual array of integers
*/
//    protected $casts = [
//        'program_package' => 'array'
//    ];
}
