<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kindergarten extends Model
{
    protected $table = 'kindergartens';
    protected $fillable = [
        'ps_id',
        'name',
        'email',
        'logo',
        'description',
        'fax',
        'facebook_url',
        'instagram_url',
        'mobile_number',
        'phone_number',
        'full_address',
        'manager_id',
    ];//end of fillable

public function kindergartenSettings(){
    return $this->hasOne('App\Model\KindergartenSettings');
}


//inverse of one to many relation

    public function manager()
    {
        return $this->belongsTo('App\Model\Manager');
    }//end of manager relation
//end inverse of one to many relation

//one to many relation
    public function teachers()
    {
        return $this->hasMany('App\Model\Teacher');
    }//end of teacher relation

    public function fathers()
    {
        return $this->hasMany('App\Model\Father');
    }//end of Fathers relation

    public function classRooms()
    {
        return $this->hasMany('App\Model\ClassRoom');
    }//end of teacher relation

    public function communicationChannels()
    {
        return $this->hasMany('App\Model\Model\CommunicationChannel');
    }//end of CommunicationChannel relation

    public function homeworks()
    {
        return $this->hasMany('App\Model\Homework');
    }//end of homework

    public function dailyRatingRecords()
    {
        return $this->hasMany('App\Model\DailyRatingRecord');
    }//end of DailyRatingRecord relation

    public function paymentHistory()
    {
        return $this->hasMany('App\Model\PaymentHistory');
    }//end of paymentHistory

    public function registerOfFinancialInstallments()
    {
        return $this->hasMany('App\Model\RegisterOfFinancialInstallment');
    }//end of RegisterOfFinancialInstallment

    public function notifications()
    {
        return $this->hasMany('App\Model\Notification');
    }//end of Notification

    public function revenues()
    {
        return $this->hasMany('App\Model\Revenue');
    }//end of Revenue

    public function expenses()
    {
        return $this->hasMany('App\Model\Expense');
    }//end of Expense

    public function staffAttendance()
    {
        return $this->hasMany('App\Model\StaffAttendance');
    }//end of StaffAttendance

    public function students()
    {
        return $this->hasMany('App\Model\Student');
    }//end of Student

    public function studentAttendances()
    {
        return $this->hasMany('App\Model\StudentAttendance');
    }//end of studentAttendance


//end one to many relation


    public function subscription()
    {
        return $this->hasOne('App\Model\Subscription');
    }//end of subscriptions relation



    public function salaries(){
        return $this->belongsTo('App\Model\Salary');
    }
}
