<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
protected $table = 'users';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telephone',
        'isAdmin'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public const ROLE_ADMIN = '3';
    public const ROLE_USER = '1';
    public const ROLE_MANAGER = '4';
    public const ROLE_ASSISTANT = '2';

    public function isManager()
    {
        return $this->isAdmin == User::ROLE_MANAGER;
    }

    public function isSuperAdmin()
    {
        return $this->isAdmin == User::ROLE_ADMIN;
    }

    public function isAssistant()
    {
        return $this->isAdmin == User::ROLE_ASSISTANT;     }

    public function isUser()
    {
        return $this->isAdmin == User::ROLE_USER;
    }

}
