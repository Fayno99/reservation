<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable =
        [
            'id',
            'text',
            'stars',
            'masters_id',
        ];

    public function master()
    {
        return $this->belongsTo(Master::class, 'masters_id');
    }


}
