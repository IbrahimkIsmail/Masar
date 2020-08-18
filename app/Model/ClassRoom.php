<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $fillable = [
        'name',
        'level', // [kg1 - kg2,]

        'manager_id',
        'kindergarten_id',
        'status',
//        'teacher_id',
//        'teacher_foreign',
    ]; // end of fillable
    /************************************************************************/
//
//one to one relation
    public function scopekindergarten_id($query,$id){
        return $query->where('kindergarten_id', $id);

    }
    public function scopeid($query,$id){
        return $query->where('id', $id);

    }
    public function student()
    {
        return $this->hasMany(Student::class);
    }//end of student relation

    public function teacher()
    {
        return $this->belongsToMany(Teacher::class);
    }//end of teacher relation

//end of one to one relation

    /************************************************************************/
//one to many relation
    public function homeworks()
    {
        return $this->hasMany('App\Model\Homework');
    }//end of homework

    public function studentAttendances()
    {
        return $this->hasMany('App\Model\StudentAttendance');
    }//end of studentAttendance
//end one to many relation
    /************************************************************************/

// Inverse  one to many relation

    public function manager()
    {
        return $this->belongsTo('App\Model\Manager');
    } // end of manager relation

    public function kindergarten()
    {
        return $this->belongsTo('App\Model\Kindergarten');
    }// end of kindergarten relation

//end of Inverse  one to many relation
    /************************************************************************/

}
