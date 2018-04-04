<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    public $timestamps = true;
    protected $fillable = ['title','cover','type_id','content','user_id','display'];
    public function type(){
        return $this->hasOne('App\Type','id','type_id');
    }
}
