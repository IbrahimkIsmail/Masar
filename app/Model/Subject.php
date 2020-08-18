<?php

namespace App\Model;

//use App\Model\Homework;
//use App\Model\Teacher;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable=['title','description'];

    function teachers(){
        return $this->belongsToMany(Teacher::class);
    }
    function homeworks(){
        return $this->hasMany(Homework::class);
    }
}
