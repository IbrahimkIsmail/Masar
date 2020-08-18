<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StaffAttendance extends Model
{
    protected $fillable = [
        'teacher_id',
        'manger_id',
        'kindergarten_id',
        'status',
    ];


    function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    //Inverse  one to many relation

    public function kindergarten()
    {
        return $this->belongsTo('App\Model\Kindergarten');
    }// end of kindergarten relation

    public function manager()
    {
        return $this->belongsTo('App\Model\Manager');
    }// end of manager relation

//end of inverse one to many relation
}
