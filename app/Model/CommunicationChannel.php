<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CommunicationChannel extends Model
{
    protected $fillable = [
//        'title',
        'message',
        'status',
        'kindergarten_id',
        'manager_id',
        'student_id',
        'from_student'
//        'father_id',

    ];//end of fillable

//inverse of one to many relation

    public function manager()
    {
        return $this->belongsTo('App\Model\Manager');
    }//end of manager relation

    public function kindergarten()
    {
        return $this->belongsTo('App\Model\Kindergarten');
    }//end of kindergarten relation

    public function student()
    {
        return $this->belongsTo('App\Model\Student');
    }//end of student relation

//end inverse of one to many relation


}
