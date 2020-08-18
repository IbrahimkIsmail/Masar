<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'url',
        'category_id',
        'user_id'
    ];//end of fillable

//inverse of one to many relation
    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    } // end of category relation

    public function user()
    {
        return $this->belongsTo('App\User');
    } // end of user relation
//end inverse of one to many relation

}
