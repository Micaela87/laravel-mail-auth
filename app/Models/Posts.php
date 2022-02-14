<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = [
        'title',
        'author',
        'content',
        'release_date',
        'rating'
    ];

    public function category() {
        return $this -> belongsTo('App\Models\Categories');
    }

    public function tags() {
        return $this -> belongsToMany('App\Models\Tags');
    }
}
