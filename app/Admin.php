<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $redirectTo = '/admin/login';
    protected $table = 'admins';
    protected $fillable = [
        'name','email','password'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
