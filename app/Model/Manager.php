<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class Manager extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'managers';
    protected $fillable = [
        'name',
        'ps_id',
        'dob',
        'image',
        'email',
        'mobile_number',
        'password',
        'full_address',
        'api_token',
//        'kindergarten_id' // i think useless
    ];

//one to one relation

    public function kindergarten()
    {
        return $this->hasOne('App\Model\Kindergarten');
    }//end of kindergarten relation

    public function subscription()
    {
        return $this->hasOne('App\Model\Subscription');
    }//end of subscriptions relation

//end of one to one relation

//one to many relation

    public function notifications()
    {
        return $this->hasMany('App\Model\Notification');
    }//end of Notification

    public function teachers()
    {
        return $this->hasMany('App\Model\Teacher');
    }//end of Teacher relation

    public function classRooms()
    {
        return $this->hasMany('App\Model\ClassRoom');
    }//end of ClassRoom relation

    public function communicationChannels()
    {
        return $this->hasMany('App\Model\CommunicationChannel');
    }//end of CommunicationChannel relation

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






    public function salaries(){
        return $this->belongsTo('App\Model\Salary');
    }


//end one to many relation


    protected $hidden = [
        'password', 'remember_token','api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}

