<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tips extends Model
{
    protected $table = 'tips';
    public $timestamps =true;
    protected $fillable = ['wisdom','author','is_screen'];
}
