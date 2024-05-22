<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryOrder extends Model
{
   // public $timestamps = false;
   // protected $table = 'temporary_orders';
    protected $fillable = [
        'session_id',
        'companies_id',
        'masters_id',
        'clients_id',
        'works_id',
        'start_order',
        'stop_order',
        'users_id' ,
        'motorcycles'
    ];
}
