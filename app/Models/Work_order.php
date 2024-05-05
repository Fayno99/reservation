<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_order extends Model
{
    use HasFactory;
    protected $table = 'work_orders';
    public $timestamps = false;
    protected $dates = ['created_at', 'updated_at', 'your_custom_date_field'];
    protected $fillable =
        [
            'id',
            'companies_id',
            'masters_id',
            'clients_id',
            'users_id',
            'works_id',
            'motorcycles',
            'start_order',
            'stop_order',
        ];
    public function master()
    {
        return $this->belongsTo(\App\Models\Master::class, 'masters_id');
    }
    public function companies()
    {
        return $this->belongsTo(\App\Models\Company::class, 'companies_id');
    }
    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class, 'clients_id');
    }
    public function work()
    {
        return $this->belongsTo(\App\Models\Work::class, 'works_id');
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'users_id');
    }
}
