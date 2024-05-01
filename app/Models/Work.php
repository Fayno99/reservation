<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;
    protected $table = 'works';
    protected $fillable =
        [
          'id',
          'name_of_work',
          'description',
          'price',
          'time_for_work'
        ];


}
