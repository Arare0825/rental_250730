<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'hid',
        'password',
        'status_pattern',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthIdentifierName()
    {
        return 'hid';
    }
    
    public function getAuthPassword()
    {
        return $this->password;
    }    
}