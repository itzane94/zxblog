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
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function tags()
    {
        /**
         * note
         * 如果中间表不是tag_article，那么需要将中间表作为第二个参数传入belongsToMany方法，
         * 如果中间表中的字段不是article_id和tag_id，这里我们姑且将其命名为$article_id和$tag_id，
         * 那么需要将$article_id作为第三个参数传入该方法，$tag_id作为第四个参数传入该方法，
         * 如果关联方法名不是tags还可以将对应的关联方法名作为第五个参数传入该方法。
         * 如果中间表包含其他字段 以下需要改写为 return $this->belongsToMany('App\Tag')->withPivot('username');
         */
        return $this->belongsToMany('App\Tag','tag_article')->withTimestamps();
    }
}
