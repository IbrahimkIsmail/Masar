<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public function videos()
    {
        return $this->hasMany('App\Model\Video');
    }//end of video relation



    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
}
