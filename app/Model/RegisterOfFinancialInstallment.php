<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RegisterOfFinancialInstallment extends Model
{

    protected $fillable = [
        'value',
        'for',
        'description',
        'student_id',
        'kindergarten_id',
        'manager_id',
        'voucher_number',
        'bond_book_serial',

    ];

    //Inverse  one to many relation
    public function scopestudent_id($query,$student_id){
        return $query->where('student_id', $student_id);
    }
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

    public function student()
    {
        return $this->belongsTo('App\Model\Student');
    }// end of student relation
    //end of inverse one to many relation
}
