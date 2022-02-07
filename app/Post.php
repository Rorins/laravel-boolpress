<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id'
    ];

    //RELATION WITH CATEGORIES
    public function category(){
        return $this->belongsTo('App\Category');
    }

    //RELATION WITH TAGS
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
