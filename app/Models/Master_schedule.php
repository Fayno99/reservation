<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_schedule extends Model
{
    use HasFactory;


    protected $table = 'master_schedules';
    public $timestamps = false;

    protected $fillable =
        [
            'id',
            'master_id',
            'work_day',

        ];
    public function master()
    {
        return $this->belongsTo(Master::class, 'masters_id');
    }
}
