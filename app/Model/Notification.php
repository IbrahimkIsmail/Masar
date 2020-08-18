<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'kindergarten_id',
        'manager_id',//
        'father_id',//
        'student_id',//
        'from_father',//
        'notification_type',
        'description',
    ];
    public function scopefather_id($query,$id){
        return $query->where('father_id', $id)->with('student');

    }
    //
    public function scopestudent_id($query,$id){
        return $query->where('student_id', $id);

    }
    public function kindergarten()
    {
        return $this->belongsTo('App\Model\Kindergarten');
    }

    public function manager()
    {
        return $this->belongsTo('App\Model\manager');
    }

    public function father()
    {
        return $this->belongsTo('App\Model\father');
    }  public function student()
    {
        return $this->belongsTo('App\Model\Student');
    }
}
