<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;
    protected $table = 'masters';
    protected $fillable =
        [
            'id',
            'name',
            'companies_id',
            'image',
            'active',
        ];
    public function companies()
    {
        return $this->belongsTo(Company::class, 'companies_id');
    }

}
