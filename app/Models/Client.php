<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    public $timestamps = false;

    protected $fillable =
        [
            'id',
            'name',
            'email',
            'password',
            'telephone',
            'Type_of_moto',
            'created_at',
            'updated_at',
        ];


}
