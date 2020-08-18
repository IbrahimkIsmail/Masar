<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DailyRatingRecord extends Model
{
    protected $fillable = [
        'student_id',
        'personal_appearance',
        'personal_hygiene',
        'child_behavior',
        'violence',
        'excellence',
        'child_health',
        'interaction_level',
        'learning_level',
        'teacher_id',
        'kindergarten_id',
        'manager_id',
    ];// end of fillable

//inverse one to many relation

    public function student()
    {
        return $this->belongsTo('App\Model\Student');
    }//end of student relation

    public function teacher()
    {
        return $this->belongsTo('App\Model\Teacher');
    }//end of student relation

    public function kindergarten()
    {
        return $this->belongsTo('App\Model\Kindergarten');
    }//end of kindergarten relation

    public function manager()
    {
        return $this->belongsTo('App\Model\Manager');
    }//end of manager relation

//end inverse one to many relation

}
