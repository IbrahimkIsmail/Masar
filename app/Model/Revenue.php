<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    // الايرادات
    protected $fillable = [
        'date',
        'serial_number',
        'value',
        'for',
        'description',
        'kindergarten_id',
        'manager_id',
    ];

    //Inverse  one to many relation

    public function kindergarten()
    {
        return $this->belongsTo('App\Model\Kindergarten');
    }// end of kindergarten relation

    public function manager()
    {
        return $this->belongsTo('App\Model\Manager');
    }// end of manager relation

//    public function father()
//    {
//        return $this->belongsTo('App\Model\Father');
//    }// end of father relation

//    public function student()
//    {
//        return $this->belongsTo('App\Model\Student');
//    }// end of student relation
//end of inverse one to many relation
}
