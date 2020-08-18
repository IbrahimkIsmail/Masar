<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'ps_id',
        'name',
        'dob',
        'father_id',
        'class_room_id',//i think must delete ! one to one relation
        'kindergarten_id',
        'manager_id',

    ];
    public function scopeid($query,$id){
        return $query->where('id', $id);

    }

    public function scopefather_id($query,$id){
        return $query->where('father_id', $id);

    }
    public function scopeclass_room_id($query,$id){
        return $query->where('class_room_id', $id);

    }
//many to many through relation
    public function teachers()
    {
        return $this->hasManyThrough(Teacher::class, ClassRoom::class);
    }//end of Student

//one to one relation

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }//end of class room relation

//end of one to one relation
    function dailyNotification()
    {
        return $this->hasMany(dailyNotification::class);
    }

    public function notifications()
    {
        return $this->hasMany('App\Model\Notification');
    }//end of Notification

//one to many relation

    public function communicationChannels()
    {
        return $this->hasMany('App\Model\CommunicationChannel');
    } //end of CommunicationChannel relation

    public function dailyRatingRecords()
    {
        return $this->hasMany('App\Model\DailyRatingRecord');
    }//end of CommunicationChannel relation

    public function homeworks()
    {
        return $this->belongsToMany(Homework::class);
    }//end of homework

    public function paymentHistories()
    {
        return $this->hasMany('App\Model\PaymentHistory');
    }//end of paymentHistory

    public function registerOfFinancialInstallments()
    {
        return $this->hasMany('App\Model\RegisterOfFinancialInstallment');
    }//end of RegisterOfFinancialInstallment

//    public function revenues()
//    {
//        return $this->hasMany('App\Model\Revenue');
//    }//end of Revenue
    public function studentAttendances()
    {
        return $this->hasMany('App\Model\StudentAttendance');
    }//end of studentAttendance


//end one to many relation

//inverse of one to many
    public function father()
    {
        return $this->belongsTo('App\Model\Father');
    }//end of father relation

//    public function teacher()
//    {
//        return $this->belongsTo('App\Model\Teacher');
//    }//end of father relation

    public function kindergarten()
    {
        return $this->belongsTo('App\Model\Kindergarten');
    }//end of kindergarten relation

    public function manager()
    {
        return $this->belongsTo('App\Model\Manager');
    }//end of manager relation
}
