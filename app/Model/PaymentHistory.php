<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $fillable = [
        'serial_number',
        'date',
        'value',
        'issue',
        'kindergarten_id',
        'manager_id',
        'father_id', // to get father ps id and more data
        'student_id',//to get student ps id and more data
    ];//end of fillable

// i think there is error here
 // end of kindergarten relation
    public function scopeStudentFeesList($query,$student_id){
        return $query->where('student_id',$student_id);
    }
    public function manager()
    {
        return $this->belongsTo('App\Model\Manager');
    }// end of manager relation

    public function father()
    {
        return $this->belongsTo('App\Model\Father');
    }// end of father relation

    public function student()
    {
        return $this->belongsTo('App\Model\Student');
    }// end of student relation

//end of Inverse  one to many relation
}
