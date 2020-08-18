<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    protected $fillable = [
        'student_id',
        'class_room_id',
        'teacher_id',
        'kindergarten_id',
        'manager_id',
        'status',
    ];
    //inverse one to many

    public function student(){
        return $this->belongsTo('App\Model\Student');
    }//end of student relation

    public function classRoom(){
        return $this->belongsTo('App\Model\ClassRoom');
    }//end of student relation

    public function kindergarten(){
        return $this->belongsTo('App\Model\Kindergarten');
    }//end of kindergarten relation

    public function teacher(){
        return $this->belongsTo('App\Model\Teacher');
    }//end of teacher relation

    public function manager(){
        return $this->belongsTo('App\Model\Manager');
    }//end of manager relation

}
