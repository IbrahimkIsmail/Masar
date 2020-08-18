<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Father extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $fillable = [
        'kindergarten_id',
        'ps_id',
        'full_name',
        'password',
        'full_address',
        'dob',
        'mobile_number',
        'api_token'
    ];//end of fillable

    public function scopekindergarten_id($query, $id)
    {
        return $query->where('kindergarten_id', $id)->with('students');
    }

    ////// There is no relation !!!!
    public function paymentHistory()
    {
        return $this->hasMany('App\Model\PaymentHistory');
    }//end of paymentHistory

    public function notifications()
    {
        return $this->hasMany('App\Model\Notification');
    }//end of Notification

//    public function registerOfFinancialInstallments()
//    {
//        return $this->hasMany('App\Model\RegisterOfFinancialInstallment');
//    }//end of RegisterOfFinancialInstallment
//    public function revenues()
//    {
//        return $this->hasMany('App\Model\Revenue');
//    }//end of Revenue

    public function kindergarten()
    {
        return $this->belongsTo('App\Model\Kindergarten');
    }//end of kindergarten relation

    public function students()
    {
        return $this->hasMany('App\Model\Student');
    }//end of Student

    protected $hidden = [
        'password', 'remember_token',
    ];

}
