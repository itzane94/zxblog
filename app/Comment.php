<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = "comments";
    public $timestamps = true;
    protected $fillable = ['article_id','username','email','site','content'];
    public function article(){
        return $this->belongsTo('App\Article');
    }
}
